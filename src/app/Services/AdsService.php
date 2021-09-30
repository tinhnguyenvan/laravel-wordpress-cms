<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Models\Ads;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class AdsService.
 *
 * @property Ads $model
 */
class AdsService extends BaseService
{
    public function __construct(Ads $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validator($params): array
    {
        $error = [];

        $validator = Validator::make(
            $params,
            [
                'title' => 'required|min:3|max:255',
            ]
        );

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        $formData['theme'] = Cookie::get('theme');
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
        $myObject = new Ads($params);

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

        return Ads::query()->findOrFail($id)->update($params);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function filter($params = []): array
    {
        $active = [
            'status' => $params['status'] ?? 0,
        ];

        $form = [
            'status' => [
                'text' => trans('post.status'),
                'type' => 'select',
                'data' => Ads::dropDownStatus(),
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

        $condition['theme'] = Cookie::get('theme');

        if (!empty($params['status'])) {
            $condition['status'] = $params['status'];
        }

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
    }

    /**
     * @param      $position
     * @param      $theme
     * @param  $limit
     *
     * @return Builder[]|Collection
     * @throws \Exception
     */
    public static function load($position, $theme, $limit = 0)
    {
        $key = $theme . '_' . $position . '_' . $limit;
        return cache()->remember(
            $key,
            3600,
            function () use ($position, $theme, $limit) {
                $model = Ads::query();
                $model->where('status', Ads::STATUS_ACTIVE);
                $model->where('position', $position);
                $model->where('theme', $theme);

                if ($limit == 1) {
                    return $model->first();
                } else {
                    return $model->get();
                }
            }
        );
    }
}
