<?php

/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Models\SaleOrderLine;
use Illuminate\Support\Facades\Validator;

/**
 * Class SaleOrderLineService.
 *
 * @property SaleOrderLine $model
 */
class SaleOrderLineService extends BaseService
{
    public function __construct(SaleOrderLine $model)
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
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if ($isNews) {
        }
    }

    /**
     * @param $params
     *
     * @return object|array|bool
     */
    public function create($params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params, true);
        $myObject = new SaleOrderLine($params);

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
        $myObject = SaleOrderLine::query()->findOrFail($id);
        $result = $myObject->update($params);

        return $result;
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

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';

        if (!empty($params['status'])) {
            $condition['status'] = $params['status'];
        }

        if (!empty($params['search'])) {
            $search = [
                ['code', 'like', $params['search'] . '%'],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }
    }
}
