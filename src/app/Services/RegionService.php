<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Region;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class RegionService.
 *
 * @property Region $model
 */
class RegionService extends BaseService
{
    public function __construct(Region $model)
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

        $validator = Validator::make(
            $params,
            [
                'name' => 'required|min:2|max:255',
            ]
        );

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if (empty($formData['code'])) {
            $formData['code'] = $formData['name'];
        }

        $formData['code'] = Str::slug($formData['code']);

        if ($isNews) {
            $countSlug = Region::query()->where('code', $formData['code'])->count();
            if ($countSlug > 0) {
                $formData['code'] .= '-' . $countSlug;
            }

            if (empty($formData['order_by'])) {
                $formData['order_by'] = 0;
            }

            if (empty($formData['source_parent_id'])) {
                $formData['level'] = 1;
                $regionLast = Region::query()->where('source_parent_id', 0)->first();
                $formData['source_id'] = $regionLast->source_id ?? 0 + 1;
            } else {
                $myObject = Region::query()->where('level', $formData['level'])
                    ->where('source_id', $formData['source_parent_id'])
                    ->first();

                $formData['level'] = $myObject->level + 1;

                $formData['source_id'] = Region::query()
                        ->where('level', $formData['level'])
                        ->where('source_parent_id', $formData['source_parent_id'])
                        ->count() + 1;
            }
        }
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
        $myObject = new Region($params);

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

        return Region::query()->findOrFail($id)->update($params);
    }

    /**
     * @return array
     */
    public function dropdownCountry()
    {
        $data = Region::query()->where('source_parent_id', 0)->where('level', 1)->orderBy('order_by')->get();
        $html = [];
        if (!empty($data)) {
            foreach ($data as $key => $myObject) {
                $html[$myObject->id] = create_line($myObject->level) . ' ' . $myObject->name;
            }
        }

        return $html;
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = 'id', &$sortType = 'asc')
    {
        if (!empty($params['search'])) {
            $search = [
                ['title', 'like', $params['search'] . '%'],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }

        if (!empty($params['source_id'])) {
            $condition['source_id'] = $params['parent_id'];
        }

        if (!empty($params['source_parent_id'])) {
            $condition['source_parent_id'] = $params['source_parent_id'];
        }

        // todo condition special
        if (!empty($params['parent_id'])) {
            $condition['source_parent_id'] = $params['parent_id'];
        }

        if (!empty($params['level'])) {
            $condition['level'] = $params['level'];
        } else {
            $condition['level'] = 1;
        }
    }

    public function getCountries()
    {
        return Region::query()->where(
            [
                'level' => 1,
            ]
        )->get();
    }

    public function getProvinces($id)
    {
        return Region::query()->where(
            [
                'level' => 2,
                'source_parent_id' => $id,
            ]
        )->get();
    }

    public function getDistricts($id)
    {
        return Region::query()->where(
            [
                'level' => 3,
                'source_parent_id' => $id,
            ]
        )->get();
    }

    public function getWards($id)
    {
        return Region::query()->where(
            [
                'level' => 4,
                'source_parent_id' => $id,
            ]
        )->get();
    }
}
