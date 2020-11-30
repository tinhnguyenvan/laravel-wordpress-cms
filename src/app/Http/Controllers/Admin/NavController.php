<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use App\Models\NavPosition;
use App\Models\RolePermission;
use App\Services\NavPositionService;
use App\Services\NavService;
use App\Services\PageService;
use App\Services\PostCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;

/**
 * Class NavController.
 *
 * @property NavService             $navService
 * @property NavPositionService     $navPositionService
 * @property PageService            $pageService
 * @property PostCategoryService    $postCategoryService
 */
class NavController extends AdminController
{
    public function __construct(
        PageService $pageService,
        NavService $navService,
        NavPositionService $navPositionService,
        PostCategoryService $postCategoryService
    ) {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::SETTING_SHOW]);
        $this->navService = $navService;
        $this->navPositionService = $navPositionService;
        $this->pageService = $pageService;
        $this->postCategoryService = $postCategoryService;
    }

    public function index(Request $request)
    {
        $position = $request->get('position');
        if ('' == $position) {
            $myNavPosition = NavPosition::query()->where('theme', Cookie::get('theme'))->first();
            $position = $myNavPosition->slug ?? 0;
        }

        $condition['position'] = $position;
        $condition['parent_id'] = 0;

        $items = Nav::query()->where($condition)->orderBy('order_by')->get();
        $itemPositions = NavPosition::query()->where('theme', Cookie::get('theme'))->get();

        $data = [
            'position' => $position,
            'items' => $items,
            'itemPositions' => $itemPositions,

            'success' => session('success'),
        ];

        return view('admin/nav.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdownPostCategory' => $this->postCategoryService->dropdown(),
            'dropdownPage' => $this->pageService->dropdown(),
            'dropdown' => $this->navService->dropdown(),
            'nav' => new Nav(),
        ];

        return view('admin/nav.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->navService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('navs?position=' . $params['position']), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('navs/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdownPostCategory' => $this->postCategoryService->dropdown(),
            'dropdownPage' => $this->pageService->dropdown(),
            'dropdown' => $this->navService->dropdown(),
            'nav' => Nav::query()->findOrFail($id),
        ];

        return view('admin/nav.form', $this->render($data));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->navService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('navs?position=' . $params['position']), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myNav = Nav::query()->findOrFail($id);
        $countChild = Nav::query()->where(['parent_id' => $id])->count();
        $position = $myNav->position;
        if (!empty($myNav->id) && 0 == $countChild) {
            Nav::destroy($id);
        }

        if ($countChild > 0) {
            $request->session()->flash('error', trans('nav.delete.exist.child'));
        } else {
            $request->session()->flash('success', trans('common.delete.success'));
        }

        return redirect(admin_url('navs?position=' . $position));
    }
}
