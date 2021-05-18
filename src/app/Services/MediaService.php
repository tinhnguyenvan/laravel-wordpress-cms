<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Ads;
use App\Models\Media;
use App\Models\Member;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class MediaService.
 *
 * @property Media $model
 */
class MediaService extends BaseService
{
    public $destinationPath;

    public function __construct(Media $model)
    {
        parent::__construct();
        $this->model = $model;
        $this->destinationPath = storage_path() . '/app/public';
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validator($params)
    {
        $error = [];

        $validator = Validator::make(
            $params,
            [
                'name' => 'required|min:1|max:255',
            ]
        );

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
    }

    public function resizeImage($fileRoot)
    {
        $img = Image::make($fileRoot);

        $img->backup();

        $img->resize(
            config('constant.MAX_FILE_SIZE_UPLOAD'),
            null,
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        );

        $img->save($fileRoot);

//        $img->resize(1000, null, function ($constraint) {
//            $constraint->aspectRatio();
//            $constraint->upsize();
//        });
//        $img->save('public/small.jpg');

        return [
            'size' => $img->filesize(),
        ];
    }

    public function uploadFile(UploadedFile $objectFile, $params = [])
    {
        $status = 0;
        $content = '';

        $extension = File::extension($objectFile->getClientOriginalName());

        if ($this->allowExtension($extension)) {
            $prefixPath = '/upload/' . date('Y/m/d');
            $fileName = 'upload_' . date('YmdHms') . '_' . uniqid() . '.' . $extension;
            $fileInfo = $objectFile->move($this->destinationPath . $prefixPath, $fileName);
            $size = $fileInfo->getSize();

            if ($fileInfo->getSize() > 0) {
                $params = [
                    'collection_name' => '',
                    'name' => $objectFile->getClientOriginalName(),
                    'file_name' => $prefixPath . '/' . $fileName,
                    'size' => $size,
                    'mime_type' => $fileInfo->getType(),
                    'disk' => $prefixPath . '/' . $fileName,
                    'custom_properties' => json_encode(
                        [
                            'path' => $fileInfo->getPath(),
                            'base_name' => $fileInfo->getBasename(),
                            'path_name' => $fileInfo->getPathname(),
                            'extension' => $fileInfo->getExtension(),
                            'real_path' => $fileInfo->getRealPath(),
                        ]
                    ),
                    'created_at' => date('Y-m-d H:i:s'),
                    'model_id' => 0,
                    'model_type' => '',
                    'creator_id' => Auth::id() ?? 0,
                    'object_type' => $params['object_type'] ?? 0,
                    'object_id' => $params['object_id'] ?? 0,
                    'manipulations' => json_encode([]),
                    'responsive_images' => json_encode([]),
                ];

                $result = $this->create($params);

                if (!empty($result->id)) {
                    $content = $result->toArray();
                    $status = 1;
                } else {
                    unlink($fileInfo->getPathname());
                }
            }
        } else {
            $content = 'error_mime_file_invalid';
        }

        return [
            'status' => $status,
            'content' => $content,
        ];
    }

    public function upload(UploadedFile $objectFile, $params = [])
    {
        $status = 0;
        $content = '';

        $mimeType = $objectFile->getMimeType();
        if ($this->allowFileUpload($mimeType)) {
            $prefixPath = '/upload/' . date('Y/m/d');
            $fileName = 'upload_' . date('YmdHms') . '_' . uniqid() . '.' . $this->getExtensionFromMineType($mimeType);
            $fileInfo = $objectFile->move($this->destinationPath . $prefixPath, $fileName);
            $size = $fileInfo->getSize();

            // resize file
            if (empty($params['is_full']) && $this->allowImageUpload($mimeType)) {
                $image = $this->resizeImage($this->destinationPath . $prefixPath . '/' . $fileName);
                $size = $image['size'] ?? 0;
            }

            if ($fileInfo->getSize() > 0) {
                $params = [
                    'collection_name' => '',
                    'name' => $objectFile->getClientOriginalName(),
                    'file_name' => $prefixPath . '/' . $fileName,
                    'size' => $size,
                    'mime_type' => $fileInfo->getType(),
                    'disk' => $prefixPath . '/' . $fileName,
                    'custom_properties' => json_encode(
                        [
                            'path' => $fileInfo->getPath(),
                            'base_name' => $fileInfo->getBasename(),
                            'path_name' => $fileInfo->getPathname(),
                            'extension' => $fileInfo->getExtension(),
                            'real_path' => $fileInfo->getRealPath(),
                        ]
                    ),
                    'created_at' => date('Y-m-d H:i:s'),
                    'model_id' => 0,
                    'model_type' => '',
                    'creator_id' => Auth::id() ?? 0,
                    'object_type' => $params['object_type'] ?? 0,
                    'object_id' => $params['object_id'] ?? 0,
                    'manipulations' => json_encode([]),
                    'responsive_images' => json_encode([]),
                ];

                $result = $this->create($params);

                if (!empty($result->id)) {
                    $content = $result->toArray();
                    $status = 1;
                } else {
                    unlink($fileInfo->getPathname());
                }
            }
        } else {
            $content = 'error_mime_file_invalid';
        }

        return [
            'status' => $status,
            'content' => $content,
        ];
    }

    public function uploadModule($params, $name = 'image')
    {
        if (empty($params['file'])) {
            return null;
        }

        $upload = $this->upload($params['file'], $params);
        if (1 == $upload['status']) {
            switch ($params['object_type']) {
                case Media::OBJECT_TYPE_POST:
                    $myObject = Post::query()->find($params['object_id']);
                    break;
                case Media::OBJECT_TYPE_POST_CATEGORY:
                    $myObject = PostCategory::query()->find($params['object_id']);
                    break;
                case Media::OBJECT_TYPE_ADS:
                    $myObject = Ads::query()->find($params['object_id']);
                    break;
                case Media::OBJECT_TYPE_MEMBER:
                    $myObject = Member::query()->find($params['object_id']);
                    break;
            }

            if (!empty($myObject)) {
                $myObject->{$name . '_id'} = $upload['content']['id'];
                $myObject->{$name . '_url'} = $upload['content']['file_name'];
                $myObject->save();

                return [
                    $name . '_id' => $myObject->{$name . '_id'},
                    $name . '_url' => $myObject->{$name . '_url'},
                ];
            } else {
                return $upload['content'];
            }
        }

        return null;
    }

    /**
     * @param $params
     *
     * @return array|bool|object
     */
    public function create($params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);
        $myObject = new Media($params);

        if ($myObject->save($params)) {
            return $myObject;
        }

        return 0;
    }

    /**
     * @param $id
     * @param $params
     *
     * @return array|bool
     */
    public function update($id, $params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);

        return Media::query()->findOrFail($id)->update($params);
    }

    /**
     * @param $mineType
     *
     * @return int
     */
    public function allowFileUpload($mineType)
    {
        $imageMineTypes = [
            'image/jpeg',
            'image/gif',
            'image/png',
            'image/bmp',
            'image/svg+xml',
            'text/plain',
            'application/pdf',
        ];

        return (int)in_array($mineType, $imageMineTypes);
    }

    public function allowExtension($mineType)
    {
        $mineTypes = [
            'xlsx',
            'xls',
            'csv',
        ];

        return (int)in_array($mineType, $mineTypes);
    }

    public function allowImageUpload($mineType)
    {
        $imageMineTypes = [
            'image/jpeg',
            'image/gif',
            'image/png',
        ];

        return (int)in_array($mineType, $imageMineTypes);
    }

    public function getExtensionFromMineType($mineType)
    {
        $imageMineTypes = [
            'image/jpeg' => 'jpeg',
            'image/gif' => 'gif',
            'image/png' => 'png',
            'text/csv' => 'csv',
            'text/plain' => 'csv',
            'application/pdf' => 'pdf',
        ];

        return $imageMineTypes[$mineType];
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';

        if (!empty($params['ids'])) {
            $search = [
                ['id', 'in', $params['ids']],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }
    }
}
