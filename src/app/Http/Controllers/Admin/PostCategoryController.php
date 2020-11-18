<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\PostCategory;
use App\Models\RolePermission;
use App\Services\MediaService;
use App\Services\PostCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class PostCategoryController.
 *
 * @property PostCategoryService $postCategoryService
 * @property MediaService $mediaService
 */
class PostCategoryController extends AdminController
{
    public function __construct(PostCategoryService $postCategoryService, MediaService $mediaService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::POST_SHOW]);
        $this->postCategoryService = $postCategoryService;
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $this->postCategoryService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = PostCategory::query()->where($condition)->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')->get();
        $data = [
            'items' => $items,
        ];

        return view('admin/post_category/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'post_category' => new PostCategory(),
        ];

        return view('admin/post_category/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->postCategoryService->create($params);
            if (empty($result['message'])) {
                // image
                if ($request->hasFile('file')) {
                    $this->mediaService->uploadModule(
                        [
                            'file' => $request->file('file'),
                            'object_type' => Media::OBJECT_TYPE_POST_CATEGORY,
                            'object_id' => $result['id'],
                        ]
                    );
                }

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('post_categories'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('post_categories/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'post_category' => PostCategory::query()->findOrFail($id),
        ];

        return view('admin/post_category/form', $this->render($data));
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
            // remove image
            if (!empty($params['file_remove'])) {
                $params['image_id'] = 0;
                $params['image_url'] = '';
            }
            $result = $this->postCategoryService->update($id, $params);

            if (empty($result['message'])) {
                // image
                if ($request->hasFile('file')) {
                    $this->mediaService->uploadModule(
                        [
                            'file' => $request->file('file'),
                            'object_type' => Media::OBJECT_TYPE_POST_CATEGORY,
                            'object_id' => $id,
                        ]
                    );
                }
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('post_categories'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = PostCategory::query()->findOrFail($id);
        $countChild = PostCategory::query()->where(['parent_id' => $id])->count();
        if (!empty($myObject->id) && 0 == $countChild) {
            PostCategory::destroy($id);
        }

        if ($countChild > 0) {
            $request->session()->flash('error', trans('common.delete.exist.child'));
        } else {
            $request->session()->flash('success', trans('common.delete.success'));
        }

        return redirect(admin_url('post_categories'));
    }
}
