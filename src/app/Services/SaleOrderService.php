<?php

/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Models\SaleOrder;
use Illuminate\Support\Facades\Validator;

/**
 * Class SaleOrderService.
 *
 * @property SaleOrder $model
 */
class SaleOrderService extends BaseService
{
    public function __construct(SaleOrder $model)
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
            'billing_fullname' => 'required|min:5|max:255',
            'billing_email' => 'required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if ($isNews) {
            $formData['slug'] = SaleOrder::generateCode();
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
        $myObject = new SaleOrder($params);

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
        $myObject = SaleOrder::query()->findOrFail($id);
        $result = $myObject->update($params);
        if ($result) {
        }

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
            'status' => $params['status'] ?? 0,
        ];

        $form = [
            'status' => [
                'text' => trans('sale_order.status'),
                'type' => 'select',
                'data' => SaleOrder::dropDownStatus(),
            ],
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

    /**
     * @param $data
     *
     * @return array
     */
    public function convertHighChart($data)
    {
        $item = [];

        for ($i = 1; $i <= 12; ++$i) {
            $item[$i] = 0;
        }

        if (!empty($data)) {
            foreach ($data as $value) {
                if (array_key_exists($value->month, $item)) {
                    $item[$value->month] = (int) $value->total;
                }
            }

            $item = array_values($item);
        }

        return $item;
    }
}
