<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\MemberTag;

/**
 * Class MemberTagService.
 *
 * @property MemberTag $model
 */
class MemberTagService extends BaseService
{
    public function __construct(MemberTag $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if (empty($formData['slug'])) {
            $formData['slug'] = $formData['name'];
        }

        $formData['slug'] = Str::slug($formData['slug']);

        if ($isNews) {
            $formData['creator_id'] = Auth::id() ?? 0;
            $countSlug = MemberTag::query()->where('slug', $formData['slug'])->count();
            if ($countSlug > 0) {
                $formData['slug'] .= '-' . $countSlug;
            }
        } else {
            $formData['editor_id'] = Auth::id() ?? 0;
        }
    }

    /**
     * @param $params
     *
     * @return object|bool
     */
    public function create($params)
    {
        $this->beforeSave($params, true);
        $myObject = new MemberTag($params);

        if ($myObject->save($params)) {
            return $myObject;
        }

        return 0;
    }

    /**
     * @param $id
     * @param $params
     * @return bool|int
     */
    public function update($id, $params)
    {
        $this->beforeSave($params);
        $myObject = MemberTag::query()->findOrFail($id);
        $result = $myObject->update($params);

        return $result;
    }

    public function buildCondition($params = [], &$condition = [], &$sortBy = null, &$sortType = null)
    {
        $sortBy = 'id';
        $sortType = 'desc';

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
    }

    /**
     * @return array
     */
    public function dropdown()
    {
        $data = MemberTag::query()->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')->get();
        $html = [];
        if (!empty($data)) {
            foreach ($data as $key => $myObject) {
                $html[$myObject->id] = create_line($myObject->level) . ' ' . $myObject->name;
            }
        }

        return $html;
    }
}
