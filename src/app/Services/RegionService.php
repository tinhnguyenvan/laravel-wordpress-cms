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

    public function dropdownCountry()
    {
        $data = Region::query()->where('parent_id', 0)->orderBy('order_by')->get(['id', 'name']);
        $html = [];
        if (!empty($data)) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }

    public function dropdownItemOfCountryByDefault(): array
    {
        $data = Region::query()
            ->whereRaw('parent_id in(SELECT id FROM master_regions WHERE parent_id = 0 AND is_primary_location = 1)')
            ->orderBy('order_by')
            ->get(['id', 'name']);
        $html = [];
        if (!empty($data)) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }


    public function dropdownRegion(): array
    {
        $items = Region::query()
            ->whereRaw('parent_id in(SELECT id FROM master_regions WHERE parent_id = 0 AND is_primary_location = 1)')
            ->orderBy('order_by')
            ->get(['id', 'name', 'parent_id']);

        $html = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                foreach ($item->subItem as $sub) {
                    $html[$item->name][$sub->id] = $sub->name;
                }
            }
        }

        return $html;
    }


    /**
     * get data 2 level
     *
     * @return array
     */
    public function dropdown(): array
    {
        $items = Region::query()->where('parent_id',0)->orderBy('order_by')->get(['id', 'name', 'parent_id']);

        $html = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                foreach ($item->subItem as $sub) {
                    $html[$item->name][$sub->id] = $sub->name;
                }
            }
        }

        return $html;
    }

    public function dropdownCityOfCountryByDefault($parentId): array
    {
        if ($parentId == 0) {
            return [];
        }
        $data = Region::query()
            ->where('parent_id', $parentId)
            ->orderBy('order_by')
            ->get(['id', 'name']);
        $html = [];
        if (!empty($data)) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = 'id', &$sortType = 'asc')
    {
        if (!empty($params['search'])) {
            $search = [
                ['name', 'like', $params['search'] . '%'],
            ];

            if (empty($condition)) {
                $condition = $search;
            } else {
                $condition = array_merge($condition, $search);
            }
        }

        if (!empty($params['parent_id'])) {
            $condition['parent_id'] = $params['parent_id'];
        }
    }
}
