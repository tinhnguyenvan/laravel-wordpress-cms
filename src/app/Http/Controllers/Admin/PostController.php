<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\Post;
use App\Models\RolePermission;
use App\Services\MediaService;
use App\Services\PostCategoryService;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class PostController.
 *
 * @property PostService         $postService
 * @property PostCategoryService $postCategoryService
 * @property MediaService        $mediaService
 */
class PostController extends AdminController
{
    public function __construct(
        PostService $postService,
        PostCategoryService $postCategoryService,
        MediaService $mediaService
    ) {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::POST_SHOW]);

        $this->mediaService = $mediaService;
        $this->postService = $postService;
        $this->postCategoryService = $postCategoryService;
    }

    public function index(Request $request)
    {
        $this->postService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Post::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $filter = $this->postService->filter($request->all());
        $data = [
            'filter' => $filter,
            'items' => $items,
        ];

        return view('admin/post.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdownCategory' => $this->postCategoryService->dropdown(),
            'post' => new Post(),
        ];

        return view('admin/post.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->postService->create($params);
            if (empty($result['message'])) {
                $this->mediaService->uploadModule([
                    'file' => $request->file('file'),
                    'object_type' => Media::OBJECT_TYPE_POST,
                    'object_id' => $result['id'],
                ]);

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('posts'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('posts/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdownCategory' => $this->postCategoryService->dropdown(),
            'post' => Post::query()->findOrFail($id),
        ];

        return view('admin/post.form', $this->render($data));
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

            $result = $this->postService->update($id, $params);

            if (empty($result['message'])) {
                $this->mediaService->uploadModule([
                    'file' => $request->file('file'),
                    'object_type' => Media::OBJECT_TYPE_POST,
                    'object_id' => $id,
                ]);

                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('posts'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Post::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            Post::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('posts'));
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
            $items = Post::query()->whereIn('id', $params['ids'])->get();
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
