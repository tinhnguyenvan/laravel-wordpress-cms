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
use Illuminate\Support\Facades\DB;

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
        $this->middleware(['permission:' . RolePermission::USER_SHOW]);
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        $this->pageService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Role::query()->where($condition)->orderBy('id', 'ASC')->paginate($this->page_number);

        $data = [
            'title' => trans('common.nav.role'),
            'items' => $items,
        ];

        return view('admin/role/index', $this->render($data));
    }

    public function permission(Request $request)
    {
        $this->pageService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $itemRoles = Role::query()->where($condition)->orderBy('id', 'ASC')->get();
        $itemPermissions = RolePermission::query()->where($condition)->orderBy('id', 'ASC')->get();

        $data = [
            'title' => trans('common.nav.role_permission'),
            'itemRoles' => $itemRoles,
            'itemPermissions' => $itemPermissions,
        ];

        return view('admin/role/permission', $this->render($data));
    }

    public function updatePermission(Request $request)
    {
        $params = $request->all();

        DB::beginTransaction();
        try {
            // lay data full
            $permissions = \Spatie\Permission\Models\Permission::all();
            $roles = \Spatie\Permission\Models\Role::all();
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    $arrRole = $params['role'] ?? [];
                    foreach ($permissions as $permission) {
                        // option 1: uncheck all permission of role
                        if (!array_key_exists($role->id, $arrRole)) {
                            $role->revokePermissionTo($permission->name);
                        } elseif (in_array($permission->id, $arrRole[$role->id])) {
                            // option 2: add checked
                            $role->givePermissionTo($permission->name);
                            $permission->assignRole($role);
                        } else {
                            // option 3: remove uncheck
                            $role->revokePermissionTo($permission->name);
                        }
                    }
                }
            }

            $request->session()->flash('success', trans('common.edit.success'));
            DB::commit();
            return redirect(admin_url('roles/permission'), 302);
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back()->withInput();
    }
}
