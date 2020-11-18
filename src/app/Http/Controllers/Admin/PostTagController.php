<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\PostTag;
use App\Models\RolePermission;
use App\Services\PostTagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class PostTagController.
 *
 * @property PostTagService $postTagService
 */
class PostTagController extends AdminController
{
    public function __construct(PostTagService $postTagService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::POST_SHOW]);

        $this->postTagService = $postTagService;
    }

    public function index(Request $request)
    {
        $this->postTagService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = PostTag::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'items' => $items,
        ];

        return view('admin/post_tag/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'post_tag' => new PostTag(),
        ];

        return view('admin/post_tag/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->postTagService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('post_tags'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('post_tags/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'post_tag' => PostTag::query()->findOrFail($id),
        ];

        return view('admin/post_tag/form', $this->render($data));
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
            $result = $this->postTagService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('post_tags'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = PostTag::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            PostTag::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('post_tags'));
    }

    /**
     * delete multi.
     *
     * @return RedirectResponse
     */
    public function destroyMulti(Request $request)
    {
        $params = $request->all();

        if (!empty($params['ids'])) {
            $items = PostTag::query()->whereIn('id', $params['ids'])->get();
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
