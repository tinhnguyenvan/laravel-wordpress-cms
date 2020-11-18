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

use App\Services\ConfigService;

/**
 * Class ConfigController.
 *
 * @property ConfigService $configService
 */
class PluginController extends AdminController
{
    public function __construct(ConfigService $configService)
    {
        parent::__construct();
        $this->configService = $configService;
    }

    public function index()
    {
        $data = [
            'plugins' => [],
            'title' => trans('nav.menu_left.plugins'),
        ];

        return view('admin/plugin.index', $this->render($data));
    }
}
