<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:17 PM
 */

namespace App\Services;

class BaseService
{
    public $model;

    public function __construct()
    {
    }

    public static function customError()
    {
        return [
            'required' => 'error_:attribute_is_required',
            'unique' => 'error_:attribute_is_exist',
            'min' => 'error_:attribute_limit_min_invalid',
            'max' => 'error_:attribute_limit_max_invalid',
            'email' => 'error_:attribute_invalid',
            'string' => 'error_:attribute_type_invalid',
            'confirmed' => 'error_:attribute_confirm_is_required',
            'size' => 'error_:attribute_length_invalid',
            'exists' => 'error_:attribute_not_found',
            'mimes' => 'error_:attribute_mime_invalid',
        ];
    }

    public function convertErrorValidator($input, &$output = [])
    {
        foreach ($input as $key => $value) {
            $output[] = $value[0];
        }
    }

    public function buildQuery($params)
    {
        if (!empty($params)) {
            return '?' . http_build_query($params);
        }
    }

    public function responseValidator($validator)
    {
        return ['message' => $validator];
    }

    /**
     * @param array $params
     * @param array $condition
     * @param null  $sortBy
     * @param null  $sortType
     *
     * @return mixed
     */
    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';
    }
}
