<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\ConfigService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property UserService $userService
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(UserService $userServices)
    {
        $this->userService = $userServices;
    }

    public function index(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect(admin_url('dashboard'));
        }
        $data = [
            'error' => session('error'),
        ];

        return view('admin/login.index', $data);
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $condition = [
            'email' => $credentials['email'],
            'status' => User::STATUS_ACTIVE,
        ];

        $myUser = User::query()->where($condition)->first();

        if (!empty($myUser) && $myUser->id > 0) {
            if (Auth::guard('admin')->attempt($credentials)) {
                $theme = ConfigService::getValue('theme_active');
                $this->userService->initData($theme);

                return redirect(admin_url('dashboard'))->withCookie(
                    'theme',
                    $theme,
                    config('constant.COOKIE_EXPIRED'),
                    '/'
                );
            } else {
                $request->session()->flash('error', trans('user.login.error'));
            }
        } else {
            $request->session()->flash('error', trans('user.login.not_exist'));
        }

        return back()->withInput();
    }
}
