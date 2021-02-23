<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Cache;
use Illuminate\Http\Request;

/**
 * Class CacheSystemController.
 *
 */
class CacheSystemController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $items = Cache::query()->paginate($this->page_number);
        $data = [
            'items' => $items,
            'title' => trans('common.list'),
        ];
        return view('admin.cache_system.index', $this->render($data));
    }

    public function delete(Request $request, $slug)
    {
        if (Cache::query()->where('key', $slug)->delete()) {
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.delete.error'));
        }
        return back();
    }
}
