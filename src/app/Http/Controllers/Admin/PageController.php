<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\RolePermission;
use App\Services\PageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class PageController.
 *
 * @property PageService $pageService
 */
class PageController extends AdminController
{
    public function __construct(PageService $pageService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::PAGE_SHOW]);
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        $this->pageService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Page::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'items' => $items,
        ];

        return view('admin/page/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'page' => new Page(),
        ];

        return view('admin/page/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->pageService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('pages'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('pages/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'page' => Page::query()->findOrFail($id),
        ];

        return view('admin/page/form', $this->render($data));
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
            $result = $this->pageService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('pages'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Page::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            Page::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('pages'));
    }

    /**
     * delete multi.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyMulti(Request $request)
    {
        $params = $request->all();

        if (!empty($params['ids'])) {
            $items = Page::query()->whereIn('id', $params['ids'])->get();
            foreach ($items as $item) {
                $item->delete();
            }
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.error_check_ids'));
        }

        return back();
    }
}
