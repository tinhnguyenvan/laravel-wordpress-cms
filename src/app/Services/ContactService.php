<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

/**
 * Class PageService.
 *
 * @property Contact $model
 */
class ContactService extends BaseService
{
    public function __construct(Contact $model)
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
            'fullname' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
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

        $this->beforeSave($params, true);
        $myObject = new Contact($params);

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

        return Contact::query()->findOrFail($id)->update($params);
    }

    /**
     * @return array
     */
    public function dropdown()
    {
        $data = Contact::all();
        $html = [];
        if (!empty($data)) {
            foreach ($data as $key => $myContact) {
                $html[$myContact->id] = $myContact->title;
            }
        }

        return $html;
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';

        if (!empty($params['search'])) {
            $search = [
                ['fullname', 'like', $params['search'] . '%'],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }
    }
}
