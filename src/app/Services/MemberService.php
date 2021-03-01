<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Mail\MemberMail;
use App\Models\Config;
use App\Models\Member;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * Class MemberService.
 *
 * @property Member $model
 */
class MemberService extends BaseService
{
    public function __construct(Member $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function table()
    {
        return $this->model->getTable();
    }

    public function renderView($theme, $view)
    {
        $manifest = @json_decode(file_get_contents(public_path('layout/' . $theme . '/manifest.json')), true);
        switch ($view) {
            case 'site.member.login':
                if (!empty($manifest['layout_member_login'])) {
                    $view = $manifest['layout_member_login'];
                }
                break;
            case 'site.member.register':
                if (!empty($manifest['layout_member_register'])) {
                    $view = $manifest['layout_member_register'];
                }
                break;
            case 'site.member.notifications':
                if (!empty($manifest['layout_member_notifications'])) {
                    $view = $manifest['layout_member_notifications'];
                }
                break;
            case 'site.member.index':
                if (!empty($manifest['layout_member_profile'])) {
                    $view = $manifest['layout_member_profile'];
                }
                break;
            case 'site.member.change_password':
                if (!empty($manifest['layout_member_change_password'])) {
                    $view = $manifest['layout_member_change_password'];
                }
                break;
            case 'site.member.update_profile':
                if (!empty($manifest['layout_member_update_profile'])) {
                    $view = $manifest['layout_member_update_profile'];
                }
                break;
            case 'site.member.coming_soon':
                if (!empty($manifest['layout_member_coming_soon'])) {
                    $view = $manifest['layout_member_coming_soon'];
                }
                break;
            case 'site.member.my_bookmark':
                if (!empty($manifest['layout_member_my_bookmark'])) {
                    $view = $manifest['layout_member_my_bookmark'];
                }
                break;
            case 'site.member.my_services':
                if (!empty($manifest['layout_member_my_services'])) {
                    $view = $manifest['layout_member_my_services'];
                }
                break;
            case 'site.member.my_service_payment_status':
                if (!empty($manifest['layout_member_my_service_payment_status'])) {
                    $view = $manifest['layout_member_my_service_payment_status'];
                }
                break;
        }

        return $view;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validator($params)
    {
        $error = [];

        if (empty($params['id'])) {
            $validator = Validator::make(
                $params,
                [
                    'username' => 'required|min:5|max:255|unique:' . $this->model->getTable(),
                    'password' => 'required|confirmed|min:1|max:255',
                ]
            );

            if ($validator->fails()) {
                static::convertErrorValidator($validator->errors()->toArray(), $error);
            }
        }

        return $error;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validatorAuth($params)
    {
        $error = [];

        $validator = Validator::make(
            $params,
            [
                'email' => 'required|min:5|max:255',
                'password' => 'required|min:1|max:255',
            ]
        );

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function auth($params)
    {
        $condition = [
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
        ];

        $myObject = Member::query()->where($condition)->first();

        if (!empty($myObject->id)) {
            $payload = [
                'iss' => env('APP_NAME'), // Issuer of the token
                'sub' => $data['id'] ?? time(), // Subject of the token
                'iat' => time(), // Time when JWT was issued.
                'exp' => time() + env('JWT_TOKEN_EXPIRED'), // Expiration time
                'data' => $myObject->toArray(),
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'));

            return [
                'user_id' => $myObject->id,
                'fullname' => $myObject->name,
                'email' => $myObject->email,
                'token' => $token,
                'avatar' => '',
            ];
        }

        return [
            'message' => 'error_not_found_data',
        ];
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if (empty($formData['id']) && !empty($formData['password'])) {
            $formData['password'] = Hash::make($formData['password']);
        }

        if ($isNews) {
            $formData['username'] = $formData['email'];
            $formData['status'] = Member::STATUS_WAITING_ACTIVE;
        }

        $fullName = '';

        if (!empty($formData['last_name'])) {
            $fullName .= $formData['last_name'];
        }

        if (!empty($formData['first_name'])) {
            $fullName .= ' ' . $formData['first_name'];
        }

        $formData['fullname'] = $fullName;
    }

    /**
     * @param $params
     * @return object|int
     */
    public function create($params)
    {
        $this->beforeSave($params, true);
        $myObject = new Member($params);
        $params['status'] = Member::STATUS_WAITING_ACTIVE;

        if ($myObject->save($params)) {
            return $myObject;
        }

        return 0;
    }

    /**
     * @param $id
     * @param $params
     *
     * @return array|bool
     */
    public function update($id, $params)
    {
        $params['id'] = $id;
        $this->beforeSave($params);

        return Member::query()->findOrFail($id)->update($params);
    }

    public function activeMember($myObject)
    {
        if (!empty($myObject->email_verified_at)) {
            return null;
        }

        try {
            $config = Config::query()->where('name', 'company_name')->first();
            Mail::send(
                new MemberMail(
                    [
                        'action' => MemberMail::ACTION_ACTIVE_MEMBER,
                        'name' => $myObject->email,
                        'email' => $myObject->email,
                        'company_name' => $config->value ?? '',
                        'link_active' => $this->linkActive($myObject),
                    ]
                )
            );
        } catch (\Exception $e) {
            Log::emergency($e->getMessage());
        }
    }


    public function linkActive($user)
    {
        return base_url('member/activemail?email=' . $user->email . '&code=' . sha1(base64_encode($user->id)));
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function filter($params = [])
    {
        $active = [
            'status' => $params['status'] ?? 0,
            'member_type' => $params['member_type'] ?? 0,
        ];

        $form = [
            'status' => [
                'text' => trans('common.status'),
                'type' => 'select',
                'data' => Member::dropDownStatus(),
            ]
        ];

        return [
            'active' => $active,
            'form' => $form,
        ];
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';

        if (!empty($params['status'])) {
            $condition['status'] = $params['status'];
        }
        if (isset($params['member_type'])) {
            $condition['member_type'] = $params['member_type'];
        }

        if (!empty($params['search'])) {
            $search = [
                ['phone', 'like', $params['search'] . '%'],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }
    }
}
