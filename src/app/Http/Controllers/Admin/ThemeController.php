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

use App\Models\RolePermission;
use App\Services\ConfigService;

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
        $this->middleware(['permission:' . RolePermission::SETTING_SHOW]);
        $this->configService = $configService;
    }

    public function index()
    {
        $directories = scandir(public_path('layout'));

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
}
