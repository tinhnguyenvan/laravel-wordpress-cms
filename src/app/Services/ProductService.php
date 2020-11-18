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

use App\Models\PostTag;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class ProductService.
 *
 * @property Product $model
 */
class ProductService extends BaseService
{
    public function __construct(Product $model)
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
            'title' => 'required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if (empty($formData['slug'])) {
            $formData['slug'] = $formData['title'];
        }

        $formData['slug'] = Str::slug($formData['slug']);

        if ($isNews) {
            $formData['creator_id'] = Auth::id() ?? 0;
            $countSlug = Product::query()->where('slug', $formData['slug'])->count();
            if ($countSlug > 0) {
                $formData['slug'] .= '-' . $countSlug;
            }
        } else {
            $formData['editor_id'] = Auth::id() ?? 0;
        }

        $formData['is_home'] = !empty($formData['is_home']) ? 1 : 0;
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
        $myObject = new Product($params);

        if ($myObject->save($params)) {
            PostTag::insertOrUpdateTags($myObject->tags, PostTag::SOURCE_PRODUCT, $myObject->id);

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

        $myObject = Product::query()->findOrFail($id);
        $result = $myObject->update($params);
        if ($result) {
            PostTag::insertOrUpdateTags($myObject->tags, PostTag::SOURCE_PRODUCT, $myObject->id);
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
            'category_id' => $params['category_id'] ?? 0,
            'status' => $params['status'] ?? 0,
        ];

        $category = $data = ProductCategory::all('id', 'title')->toArray();

        $form = [
            'category_id' => [
                'text' => trans('post.category_id'),
                'type' => 'select',
                'data' => !empty($category) ? array_column($category, 'title', 'id') : '',
            ],
            'status' => [
                'text' => trans('post.status'),
                'type' => 'select',
                'data' => Product::dropDownStatus(),
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

        if (!empty($params['category_id'])) {
            $condition['category_id'] = $params['category_id'];
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
     * @param $tags
     *
     * @return string
     */
    public static function renderTag($tags)
    {
        if (empty($tags)) {
            $html = null;
        }

        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $html[] = '<a href="' . base_url('tag/' . Str::slug((string) $tag)) . '">' . $tag . '</a>';
        }

        return !empty($html) ? implode(PHP_EOL, $html) : '';
    }

    /**
     * @param $slugCategory
     * @param $paramRequest
     *
     * @return LengthAwarePaginator
     */
    public function getProductBySlugCategory($slugCategory, $paramRequest)
    {
        $this->buildCondition($paramRequest, $condition, $sortBy, $sortType);

        return Product::query()->where($condition)
            ->whereHas('category', function (Builder $query) use ($slugCategory) {
                $query->where('slug', $slugCategory)->orWhereHas('children', function (Builder $query) use ($slugCategory) {
                    $query->where('slug', $slugCategory);
                });
            })->with('category.children')->orderBy($sortBy, $sortType)->paginate(config('constant.PAGE_NUMBER'));
    }

    public static function getProductByCategoryId($categoryId, $limit = 4)
    {
        $condition = ['status' => Product::STATUS_ACTIVE];
        return Product::query()->where($condition)
            ->whereHas('category', function (Builder $query) use ($categoryId) {
                $query->where('id', $categoryId)->orWhereHas('children', function (Builder $query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            })
            ->with('category.children')
            ->orderBy('id', 'desc')
            ->get()
            ->take($limit);
    }
}
