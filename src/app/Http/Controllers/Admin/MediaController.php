<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\RolePermission;
use App\Services\MediaService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class MediaController.
 *
 * @property MediaService $mediaService
 */
class MediaController extends AdminController
{
    public function __construct(MediaService $mediaService)
    {
        parent::__construct();
        $this->middleware(['permission:'.RolePermission::MEDIA_SHOW]);
        $this->mediaService = $mediaService;
    }

    /**
     * @param  Request  $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->mediaService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Media::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'title' => trans('media.title_index'),
            'items' => $items,
        ];

        return view('admin/media.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'media' => new Media(),
        ];

        return view('admin/media.form', $this->render($data));
    }

    public function store(Request $request)
    {
        if ($request->file('file')) {
            $objectFile = $request->file('file');

            $upload = $this->mediaService->upload($objectFile);

            if (1 == $upload['status']) {
                $request->session()->flash('success', trans('common.upload.success'));

                return redirect(admin_url('medias'), 302);
            } else {
                $request->session()->flash('error', trans('common.upload.error'));
            }
        } else {
            $request->session()->flash('error', 'error_file_invalid');
        }

        return back()->withInput();
    }

    /**
     * upload content for ckeditor
     *
     * @param  Request  $request
     * @return array
     */
    public function upload(Request $request)
    {
        $type = $request->get('type');
        $url = '';
        if ($request->file('upload')) {
            $objectFile = $request->file('upload');

            $upload = $this->mediaService->upload($objectFile);
            if (1 == $upload['status']) {
                $url = asset('storage'.$upload['content']['file_name']);

                $msg = 'Image uploaded successfully';
            } else {
                $msg = trans('common.upload.error');
            }
        } else {
            $msg = trans('error_file_invalid');
        }

        if ($type == 'ckeditor') {
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        } else {
            return [
                'status' => !empty($url) ? 1 : 0,
                'name' => $upload['content']['name'] ?? '',
                'file_name' => $upload['content']['file_name'] ?? '',
                'file_id' => $upload['content']['id'] ?? 0,
                'url' => $url,
                'message' => $msg,
            ];
        }
    }

    public function show($id)
    {
        return redirect(admin_url('medias/'.$id.'/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'media' => Media::query()->findOrFail($id),
        ];

        return view('admin/media.form', $this->render($data));
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->mediaService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('medias'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $this->mediaService->delete($id);

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('medias'));
    }

    public function destroyMulti(Request $request)
    {
        $params = $request->all();

        if (!empty($params['ids'])) {
            $items = Media::query()->whereIn('id', $params['ids'])->get();
            foreach ($items as $item) {
                $this->mediaService->delete($item->id);
            }
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.error_check_ids'));
        }

        return redirect(admin_url('medias'));
    }
}
