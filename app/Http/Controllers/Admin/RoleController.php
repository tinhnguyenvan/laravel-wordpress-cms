<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\RolePermission;
use App\Services\PageService;
use App\Services\RoleService;
use Illuminate\Http\Request;

/**
 * Class PageController.
 *
 * @property PageService $pageService
 */
class RoleController extends AdminController
{
    public function __construct(RoleService $pageService)
    {
        parent::__construct();
        $this->middleware(['permission:'.RolePermission::USER_SHOW]);
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        $this->pageService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Role::query()->where($condition)->orderBy('id', 'ASC')->paginate($this->page_number);

        $data = [
            'items' => $items,
            'error' => session('error'),
        ];

        return view('admin/role/index', $this->render($data));
    }
}
