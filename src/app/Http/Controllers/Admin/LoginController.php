<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\ConfigService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @property UserService $userService
 */
class LoginController extends Controller
{
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

    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect(admin_url());
        }
        $data = [
            'error' => session('error'),
        ];

        return view('admin/login.index', $data);
    }

    public function auth(Request $request)
    {
        $rules = [
            'email' => 'required|min:5|max:255',
            'password' => 'required|min:1|max:255',
        ];

        if (config('services.recaptcha.enable')) {
            $rules['g-recaptcha-response'] = 'required|min:5|recaptcha';
        }

        $request->validate($rules);

        $credentials = $request->only('email', 'password');

        $condition = [
            'email' => $credentials['email'],
            'status' => User::STATUS_ACTIVE,
        ];

        $myUser = User::query()->where($condition)->first();

        if (!empty($myUser) && $myUser->id > 0) {
            if (Auth::guard('admin')->attempt($credentials, true)) {
                $theme = ConfigService::getValue('theme_active');
                $plugin = Plugin::query()->where('status', 1)->get(['code'])->toArray();
                if (!empty($plugin)) {
                    $plugins = implode(',', array_column($plugin, 'code'));
                } else {
                    $plugins = '';
                }
                $this->userService->initData($theme);
                return redirect(admin_url())
                    ->withCookie('plugin', $plugins, config('constant.COOKIE_EXPIRED'), '/')
                    ->withCookie('theme', $theme, config('constant.COOKIE_EXPIRED'), '/');
            } else {
                $request->session()->flash('error', trans('user.login.error'));
            }
        } else {
            $request->session()->flash('error', trans('user.login.not_exist'));
        }


        return back()->withInput();
    }
}
