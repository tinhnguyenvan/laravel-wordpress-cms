<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 7:39 PM
 */

/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use App\Models\RolePermission;
use App\Services\ConfigService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class ConfigController.
 *
 * @property ConfigService $configService
 */
class ThemeController extends AdminController
{
    public function __construct(ConfigService $configService)
    {
        parent::__construct();
        $this->middleware(['permission:'.RolePermission::SETTING_SHOW]);
        $this->configService = $configService;
    }

    public function index()
    {
        $directories = [];
        if (Storage::exists(public_path('layout'))) {
            $directories = scandir(public_path('layout'));
        }

        $data = [
            'title' => trans('common.title_themes'),
            'directories' => $directories,
            'theme_active' => ConfigService::getValue('theme_active'),
        ];

        return view('admin/theme.index', $this->render($data));
    }

    public function css()
    {
        $config = $this->configService->getConfig();

        $data = [
            'config' => $config,
        ];

        return view('admin/theme.css', $this->render($data));
    }

    public function active(Request $request): RedirectResponse
    {
        $theme = $request->get('theme_active');
        $myConfig = Config::query()->where('name', 'theme_active')->first();

        if (!empty($myConfig)) {
            $myConfig->editor_id = Auth::id();
            $myConfig->value = $theme;
            $myConfig->save();
        }

        return back()->withInput()->withCookie('theme', $theme, config('constant.COOKIE_EXPIRED'), '/');
    }
}
