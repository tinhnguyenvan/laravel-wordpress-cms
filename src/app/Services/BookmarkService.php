<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Validator;

/**
 * Class BookmarkService.
 */
class BookmarkService extends BaseService
{
    public function __construct(Bookmark $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validator($params)
    {
        $error = [];

        $validator = Validator::make($params, [
            'model_id' => 'required',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function filter($params = [])
    {
        $active = [
        ];

        $form = [
        ];

        return [
            'active' => $active,
            'form' => $form,
        ];
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        $auth = session('auth');
        $formData['user_id'] = $auth['id'] ?? 0;
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
        $myObject = new Bookmark($params);

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

        return Bookmark::query()->findOrFail($id)->update($params);
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';
    }
}
