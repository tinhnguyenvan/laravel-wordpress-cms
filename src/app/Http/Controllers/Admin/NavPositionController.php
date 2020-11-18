<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\NavPosition;
use App\Models\RolePermission;
use App\Services\NavPositionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class NavPositionController.
 *
 * @property NavPositionService $navPositionService
 */
class NavPositionController extends AdminController
{
    public function __construct(NavPositionService $navPositionService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::SETTING_SHOW]);
        $this->navPositionService = $navPositionService;
    }

    public function index(Request $request)
    {
        $this->navPositionService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = NavPosition::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'items' => $items,
        ];

        return view('admin/nav_position/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'nav_position' => new NavPosition(),
        ];

        return view('admin/nav_position/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->navPositionService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('nav_positions'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('nav_positions/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'nav_position' => NavPosition::query()->findOrFail($id),
        ];

        return view('admin/nav_position/form', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->navPositionService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('nav_positions'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = NavPosition::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            NavPosition::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('nav_positions'));
    }
}
