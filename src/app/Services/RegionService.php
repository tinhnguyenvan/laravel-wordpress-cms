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
     * @param array $params
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
     * @param array $params
     *
     * @return array
     */
    public function create($params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params, true);

        return Region::query()->create($params)->toArray();
    }

    /**
     * @param int $id
     * @param array $params
     *
     * @return array|bool|int
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

    public function dropDownCountry()
    {
        $data = Region::query()->where('parent_id', 0)->orderBy('order_by')->get(['id', 'name']);
        $html = [];
        if ($data->count() > 0) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }

    public function dropDownItemOfCountryByDefault(): array
    {
        $data = Region::query()
            ->whereRaw('parent_id in(SELECT id FROM master_regions WHERE parent_id = 0 AND is_primary_location = 1)')
            ->orderBy('order_by')
            ->get(['id', 'name']);
        $html = [];
        if ($data->count() > 0) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }


    public function dropDownRegion(): array
    {
        $items = Region::query()
            ->whereRaw('parent_id in(SELECT id FROM master_regions WHERE parent_id = 0 AND is_primary_location = 1)')
            ->orderBy('order_by')
            ->get(['id', 'name', 'parent_id']);

        $html = [];
        if ($items->count() > 0) {
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
    public function dropDown(): array
    {
        $items = Region::query()->where('parent_id', 0)->orderBy('order_by')->get(['id', 'name', 'parent_id']);

        $html = [];
        if ($items->count()) {
            foreach ($items as $item) {
                foreach ($item->subItem as $sub) {
                    $html[$item->name][$sub->id] = $sub->name;
                }
            }
        }

        return $html;
    }

    public function dropDownCityOfCountryByDefault($parentId): array
    {
        if ($parentId == 0) {
            return [];
        }
        $data = Region::query()->where('parent_id', $parentId)->orderBy('order_by')->get(['id', 'name']);
        $html = [];
        if ($data->count() > 0) {
            $html = array_column($data->toArray(), 'name', 'id');
        }

        return $html;
    }

    /**
     * @param array $params
     * @param array $condition
     * @param string $sortBy
     * @param string $sortType
     * @return mixed|void
     */
    public function buildCondition($params = [], &$condition = [], &$sortBy = '', &$sortType = '')
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
