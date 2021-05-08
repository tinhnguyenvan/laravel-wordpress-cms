<?php

namespace App\Http\Controllers\Site;

use App\Jobs\MemberJob;
use App\Models\Bookmark;
use App\Models\Media;
use App\Models\Member;
use App\Models\MemberSocialAccount;
use App\Models\Notification;
use App\Models\Post;
use App\Models\RolePermission;
use App\Services\MediaService;
use App\Services\MemberService;
use App\Services\PostService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class MemberController.
 *
 * @property MemberService $memberService
 * @property PostService $postService
 * @property MediaService $mediaService
 */
final class MemberController extends SiteController
{
    public function __construct(
        PostService $postService,
        MemberService $memberService,
        MediaService $mediaService
    ) {
        parent::__construct();
        $this->postService = $postService;
        $this->memberService = $memberService;
        $this->mediaService = $mediaService;
        $this->data['active_menu'] = '';
    }

    public function index()
    {
        $data = [
            'member' => auth(RolePermission::GUARD_NAME_WEB)->user(),
            'active_menu' => 'member',
            'title' => trans('member.title_profile'),
        ];
        $view = $this->memberService->renderView($this->theme, 'site.member.index');
        return view($view, $this->render($data));
    }

    public function login()
    {
        if (auth(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member'));
        }

        $data = [
            'title' => 'Login',
            'active_menu' => ''
        ];

        $view = $this->memberService->renderView($this->theme, 'site.member.login');
        return view($view, $this->render($data));
    }

    public function handleLogin(Request $request)
    {
        if (auth(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member'));
        }

        $rules = [
            'email' => 'required|min:5|max:255',
            'password' => 'required|min:1|max:255',
        ];

        if (config('services.recaptcha.enable')) {
            $rules['g-recaptcha-response'] = 'required|min:5|recaptcha';
        }

        $request->validate($rules);

        $params = $request->only('email', 'password', 'member_type');
        $credentials = $params;
        $credentials['status'] = Member::STATUS_ACTIVE;
        if (auth(RolePermission::GUARD_NAME_WEB)->attempt($credentials)) {
            $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();
            $conditionSocial = [
                'member_id' => $member->id,
                'provider_id' => $member->id,
                'provider' => MemberSocialAccount::PROVIDER_EMAIL,
            ];
            $memberSocialAccount = MemberSocialAccount::query()->where($conditionSocial)->first();
            if (!empty($member) && !empty($memberSocialAccount)) {
                /** @var Member $member */
                auth(RolePermission::GUARD_NAME_WEB)->login($member);
                if ($request->get('redirect')) {
                    return redirect($request->get('redirect'));
                } else {
                    return redirect(base_url('member'));
                }
            } else {
                $request->session()->flash('error', trans('member.error_member_not_exist'));
            }
        } else {
            $request->session()->flash('error', trans('member.login.error'));
        }

        return back()->withInput()->withErrors(trans('member.login.not_exist'));
    }

    public function register()
    {
        if (auth(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member'));
        }

        $data = [
            'active_menu' => ''
        ];

        $view = $this->memberService->renderView($this->theme, 'site.member.register');

        return view($view, $this->render($data));
    }

    public function handleRegister(Request $request)
    {
        $isValidator = false;

        if (auth(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member'));
        }

        $rules = [
            'email' => 'required|min:5|max:255',
            'password' => 'required|confirmed|min:1|max:255',
            'password_confirmation' => 'required|same:password|min:6',
        ];

        if (config('services.recaptcha.enable')) {
            $rules['g-recaptcha-response'] = 'required|min:5|recaptcha';
        }

        $request->validate($rules);


        $params = $request->only(['email', 'password', 'password_confirmation']);
        $member = Member::query()->where('email', $params['email'])->first();
        if (!empty($member->id)) {
            if (empty($member->socials)) {
                $isValidator = true;
            }

            if (empty(!$member->socials)) {
                foreach ($member->socials as $social) {
                    if ($social->provider == MemberSocialAccount::PROVIDER_EMAIL) {
                        $isValidator = false;
                        break;
                    }

                    $isValidator = true;
                }
            }
        } else {
            $isValidator = true;
        }

        if ($isValidator) {
            $params['member_type'] = Member::MEMBER_TYPE_NORMAL;
            if (empty($member)) {
                $member = $this->memberService->create($params);
            } else {
                $params['status'] = Member::STATUS_WAITING_ACTIVE;
                $params['password'] = Hash::make($params['password']);
                $this->memberService->update($member->id, $params);
            }

            if (!empty($member->id)) {
                MemberSocialAccount::query()->create(
                    [
                        'member_id' => $member->id,
                        'provider_id' => $member->id,
                        'provider' => MemberSocialAccount::PROVIDER_EMAIL,
                    ]
                );

                Member::query()->where('id', $member->id)->update(['id_hash' => md5($member->id)]);

                // send mail active
                $this->memberService->activeMember($member);

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(base_url('member/register'), 302);
            } else {
                $message = trans('common.add.error');
            }
        } else {
            $message = trans('member.error_member_exist');
        }

        $request->session()->flash('error', $message);
        return back()->withInput();
    }

    public function updateProfile()
    {
        $data = [
            'member' => auth(RolePermission::GUARD_NAME_WEB)->user(),
            'title' => trans('member.title_update_profile'),
            'active_menu' => 'update-profile'
        ];
        $view = $this->memberService->renderView($this->theme, 'site.member.update_profile');
        return view($view, $this->render($data));
    }

    public function handleUpdateProfile(Request $request)
    {
        $params = $request->all();

        $request->validate(
            [
                'first_name' => 'required|min:1|max:255',
            ]
        );

        // remove image
        if (!empty($params['file_remove'])) {
            $params['image_id'] = 0;
            $params['image_url'] = '';
        }

        $id = auth(RolePermission::GUARD_NAME_WEB)->id();
        $result = $this->memberService->update($id, $params);

        if (empty($result['message'])) {
            $this->mediaService->uploadModule(
                [
                    'file' => $request->file('file'),
                    'object_type' => Media::OBJECT_TYPE_MEMBER,
                    'object_id' => $id,
                ]
            );

            $request->session()->flash('success', trans('common.edit.success'));
            return redirect(base_url('member/update-profile'), 302);
        }

        return back()->withErrors($result['message']);
    }

    public function changePassword()
    {
        $data = [
            'title' => trans('member.title_change_password'),
            'active_menu' => 'change-password'
        ];
        $view = $this->memberService->renderView($this->theme, 'site.member.change_password');
        return view($view, $this->render($data));
    }

    public function handleChangePassword(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password|min:6',
            ]
        );

        $id = auth(RolePermission::GUARD_NAME_WEB)->id();
        $params = $request->only(['password', 'password_confirm']);

        $myUser = Member::query()->findOrFail($id);
        $myUser->password = Hash::make($params['password']);
        $myUser->save();

        $request->session()->flash('success', trans('member.update.password_success'));

        return redirect(base_url('member'), 302);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function activeMail(Request $request)
    {
        $params = $request->only(['email', 'code']);
        $condition = [
            'email' => $params['email'],
            'status' => Member::STATUS_WAITING_ACTIVE,
        ];

        $member = Member::query()->where($condition)->first();

        if (!empty($member->id)) {
            $conditionSocial = [
                'member_id' => $member->id,
                'provider_id' => $member->id,
                'provider' => MemberSocialAccount::PROVIDER_EMAIL,
            ];
            $memberSocialAccountAccount = MemberSocialAccount::query()->where($conditionSocial)->first();
            if (!empty($memberSocialAccountAccount)) {
                $member->status = Member::STATUS_ACTIVE;
                $member->updated_at = now();
                $member->save();

                // send mail
                MemberJob::dispatch(['action' => MemberJob::ACTION_ACTIVE_SUCCESS, 'id' => $member->id]);

                // redirect message
                $request->session()->flash('success', trans('member.active.success'));

                return redirect(base_url('member/login'), 302);
            } else {
                $request->session()->flash('error', trans('member.error_member_not_exist'));
            }
        } else {
            $request->session()->flash('error', trans('member.active.error'));
        }

        return redirect(base_url('member/login'));
    }

    public function forgot()
    {
        $data = [
            'title' => trans('member.title_forgot'),
            'active_menu' => ''
        ];

        return view('site.member.forgot', $this->render($data));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function handleForgot(Request $request)
    {
        $params = $request->only(['email']);
        $condition = [
            'email' => $params['email'],
            'status' => Member::STATUS_ACTIVE,
        ];

        $member = Member::query()->where($condition)->where('password', '!=', '')->first();

        if (!empty($member->id)) {
            $conditionSocial = [
                'member_id' => $member->id,
                'provider_id' => $member->id,
                'provider' => MemberSocialAccount::PROVIDER_EMAIL,
            ];
            $memberSocialAccount = MemberSocialAccount::query()->where($conditionSocial)->first();
            if (!empty($memberSocialAccount)) {
                $password = substr(uniqid(), 0, 10);
                $member->updated_at = now();
                $member->password = Hash::make($password);
                $member->save();

                // send mail
                MemberJob::dispatch(
                    [
                        'action' => MemberJob::ACTION_FORGOT_PASSWORD,
                        'id' => $member->id,
                        'password' => $password
                    ]
                );

                // redirect message
                $request->session()->flash('success', trans('member.forgot_password.success'));

                return redirect(base_url('member/login'), 302);
            } else {
                $message = trans('member.error_member_not_exist');
            }
        } else {
            $message = trans('member.forgot.empty');
        }

        $request->session()->flash('error', $message);
        return redirect(base_url('member/forgot'));
    }

    public function loginSocial(Request $request, $provider)
    {
        session(['redirect_social' => $request->get('redirect')]);
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, $provider): RedirectResponse
    {
        try {
            $getInfo = Socialite::driver($provider)->user();
            $memberSocialAccountAccount = MemberSocialAccount::query()
                ->where('provider', $provider)
                ->where('provider_id', $getInfo->getId())
                ->first();

            if (!empty($memberSocialAccountAccount)) {
                $member = $memberSocialAccountAccount->member;
            } else {
                $email = $getInfo->getEmail() ?? $getInfo->getNickname();
                $memberSocialAccountAccount = new MemberSocialAccount(
                    [
                        'provider_id' => $getInfo->getId(),
                        'provider' => $provider
                    ]
                );

                $member = Member::query()->where('email', $email)->first();

                if (!$member) {
                    $member = Member::query()->create(
                        [
                            'email' => $email,
                            'username' => $email,
                            'fullname' => $getInfo->getName(),
                            'image_url' => $getInfo->getAvatar(),
                        ]
                    );

                    Member::query()->where('id', $member->id)->update(['id_hash' => md5($member->id)]);
                }

                $memberSocialAccountAccount->member()->associate($member);
                $memberSocialAccountAccount->save();
            }

            if (!empty($member->id)) {
                /** @var Member $myMember */
                $myMember = Member::query()->where('id', $member->id)->first();
                auth(RolePermission::GUARD_NAME_WEB)->login($myMember);
            }
        } catch (Exception $e) {
            return redirect()->to('member/login');
        }

        $redirect = session('redirect_social');
        if (!empty($redirect)) {
            return redirect()->to($redirect);
        } else {
            return redirect()->to('member');
        }
    }

    public function logout()
    {
        auth(RolePermission::GUARD_NAME_WEB)->logout();
        return redirect(base_url('member/login'));
    }

    public function notifications()
    {
        $memberId = auth(RolePermission::GUARD_NAME_WEB)->id();
        $member = Member::find($memberId);
        $data = [
            'title' => 'Notification',
            'active_menu' => '',
            'member' => $member,
        ];
        $view = $this->memberService->renderView($this->theme, 'site.member.notifications');
        return view($view, $this->render($data));
    }

    public function makeReadNotification(Request $request, $id): RedirectResponse
    {
        $notification = Notification::query()->findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        return back();
    }

    public function myBookmarkPost(Request $request)
    {
        $type = $request->input('type') ?? 1;
        $object = Bookmark::query();

        $object->where('model_type', Post::class);
        $object->where('member_id', auth(RolePermission::GUARD_NAME_WEB)->id());

        $items = $object->orderBy('id')->paginate(config('constant.PAGE_NUMBER'));

        $data = [
            'items' => $items,
            'title' => 'My bookmark',
            'active_menu' => 'my-bookmarks_' . $type,
        ];

        $view = $this->memberService->renderView($this->theme, 'site.member.my_bookmark');
        return view($view, $this->render($data));
    }

}
