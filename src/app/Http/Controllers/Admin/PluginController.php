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

use App\Models\Plugin;
use App\Services\PluginService;

/**
 * Class PluginController.
 *
 * @property PluginService $pluginService
 */
class PluginController extends AdminController
{
    public function __construct(PluginService $pluginService)
    {
        parent::__construct();
        $this->pluginService = $pluginService;
    }

    public function index()
    {
        $items = Plugin::all();
        $data = [
            'items' => $items,
            'title' => trans('nav.menu_left.plugins'),
        ];

        return view('admin/plugin.index', $this->render($data));
    }
}
