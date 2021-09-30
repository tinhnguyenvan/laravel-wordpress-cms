<?php
/**
 * @author: nguyentinh
 * @create: 2021/09/03, 22:43 PM
 */

namespace App\Http\Controllers\Site;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

/**
 * @property MediaService $mediaService
 */
class MediaController extends SiteController
{
    public function __construct(MediaService $mediaService)
    {
        parent::__construct();
        $this->mediaService = $mediaService;
    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function upload(Request $request): array
    {
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

        return [
            'status' => !empty($url) ? 1 : 0,
            'name' => $upload['content']['name'] ?? '',
            'file_name' => $upload['content']['file_name'] ?? '',
            'file_id' => $upload['content']['id'] ?? 0,
            'url' => $url,
            'message' => $msg,
        ];
    }

    public function destroy($id): array
    {
        $myFile = Media::query()->where('id', $id)->first();
        if (!empty($myFile->id) && !empty($myFile->model_type)) {
            $model = $myFile->model_type::query()->where('id', $myFile->model_id)->first();
            if (!empty($model->id)) {
                $model->image_url = '';
                $model->image_id = 0;
                $model->save();
            }
        }

        return [
            'status' => $this->mediaService->delete($id)
        ];
    }

}
