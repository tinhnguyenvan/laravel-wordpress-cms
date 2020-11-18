<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class UserController.
 *
 * @property UserService $userService
 * @property RoleService $roleService
 */
class UserController extends AdminController
{
    public function __construct(UserService $userServices, RoleService $roleService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::USER_SHOW])->except('logout');

        $this->userService = $userServices;
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $this->userService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = User::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'items' => $items,
        ];

        return view('admin/user.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdownRole' => $this->roleService->dropdown(),
        ];

        return view('admin/user.create', $this->render($data));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $params = $request->all();

        if (!empty($params['_token'])) {
            $result = $this->userService->create($params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('users'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show()
    {
        $user = User::query()->findOrFail(Auth::id());

        $data = [
            'dropdownRole' => $this->roleService->dropdown(),
            'user' => $user,
        ];

        return view('admin/user.profile', $this->render($data));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $data = [
            'title' => trans('user.title_update'),
            'users' => User::query()->findOrFail($id),
            'dropdownRole' => $this->roleService->dropdown(),
        ];

        return view('admin/user.edit', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->userService->update($id, $params);

            if (empty($result['message'])) {
                $myUser = User::query()->find($id);
                if (!empty($myUser) && User::STATUS_ACTIVE == $myUser->status) {
                    $myUser->syncRoles([Role::ROLE_KEY[$myUser->role_id]]);
                }

                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('users'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function active(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $result = $this->userService->activeUser($user);

        if (empty($result['message'])) {
            $request->session()->flash('success', trans('user.active.success'));

            return redirect(admin_url('users'), 302);
        } else {
            $request->session()->flash('error', $result);
        }

        return back()->withInput();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, $id)
    {
        $myObject = User::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            User::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('users'), 302);
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function resetPassword($id)
    {
        $data = [
            'title' => trans('user.title_reset_password'),
            'users' => User::query()->findOrFail($id),
        ];

        return view('admin/user.reset_password', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function updateResetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password|min:6',
        ]);

        $params = $request->only(['password', 'password_confirm']);

        $myUser = User::query()->findOrFail($id);
        $myUser->password = Hash::make($params['password']);
        $myUser->save();

        $request->session()->flash('success', trans('user.update.password_success'));

        return redirect(admin_url('users/' . $id), 302);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(admin_url('login'));
    }
}
