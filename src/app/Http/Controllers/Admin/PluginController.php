<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 7:39 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Plugin;
use App\Services\PluginService;
use Illuminate\Http\Request;

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

    public function updateStatus(Request $request)
    {
        $params = $request->only(['id', 'status']);

        $plugin = Plugin::query()->findOrFail($params['id']);
        $plugin->status = !empty($params['status']) && $params['status'] == 'on' ? 1 : 0;
        $plugin->save();

        // set cookie reload
        $plugins = Plugin::query()->where('status', 1)->get(['code']);
        if (!empty($plugins)) {
            $plugins = implode(',', array_column($plugins->toArray(), 'code'));
        }

        $request->session()->flash('success', trans('common.edit.success'));
        return redirect(admin_url('plugins'))->withCookie('plugin', $plugins, config('constant.COOKIE_EXPIRED'), '/');
    }

    public function updateRouter(Request $request)
    {
        $params = $request->only(['id', 'is_home_route']);
        $plugin = Plugin::query()->findOrFail($params['id']);

        $plugin->is_home_route = !empty($params['is_home_route']) && $params['is_home_route'] == 'on' ? 1 : 0;
        $plugin->save();
        $request->session()->flash('success', trans('common.edit.success'));
        return redirect(admin_url('plugins'));
    }
}
