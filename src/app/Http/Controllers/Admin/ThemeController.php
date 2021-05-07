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
        if (is_dir(public_path('layout'))) {
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

        if (empty($config['theme_active'])) {
            $themeActiveCss = 'default_css';
        } else {
            $themeActiveCss = $config['theme_active'].'_css';
        }

        $data = [
            'config' => $config,
            'theme_active_css' => $themeActiveCss,
        ];

        return view('admin/theme.css', $this->render($data));
    }

    public function active(Request $request): RedirectResponse
    {
        $theme = $request->get('theme_active');
        $dataCondition = [
            'name' => 'theme_active'
        ];

        $dataUpdate = [
            'editor_id' => Auth::id(),
            'value' => $theme
        ];

        Config::query()->updateOrCreate($dataCondition, $dataUpdate);

        return back()->withInput()->withCookie('theme', $theme, config('constant.COOKIE_EXPIRED'), '/');
    }
}
