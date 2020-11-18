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

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class PostService.
 *
 * @property Post $model
 */
class PostService extends BaseService
{
    public function __construct(Post $model)
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
                'title' => 'required|min:5|max:255',
            ]
        );

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
            $countSlug = Post::query()->where('slug', $formData['slug'])->count();
            if ($countSlug > 0) {
                $formData['slug'] .= '-' . $countSlug;
            }
        } else {
            $formData['editor_id'] = Auth::id() ?? 0;
        }

        $formData['is_hot'] = !empty($formData['is_hot']) ? 1 : 0;
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
        $myObject = new Post($params);

        if ($myObject->save($params)) {
            PostTag::insertOrUpdateTags($myObject->tags, PostTag::SOURCE_POST, $myObject->id);

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
        $myObject = Post::query()->findOrFail($id);
        $result = $myObject->update($params);
        if ($result) {
            PostTag::insertOrUpdateTags($myObject->tags, PostTag::SOURCE_POST, $myObject->id);
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

        $category = $data = PostCategory::all('id', 'title')->toArray();

        $form = [
            'category_id' => [
                'text' => trans('post.category_id'),
                'type' => 'select',
                'data' => !empty($category) ? array_column($category, 'title', 'id') : '',
            ],
            'status' => [
                'text' => trans('post.status'),
                'type' => 'select',
                'data' => Post::dropDownStatus(),
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
     * @param $limit
     *
     * @return object
     */
    public static function newest($limit = 5)
    {
        $data = Post::query()->orderByRaw('id desc')->get()->take($limit);

        return $data;
    }

    public function getPostBySlugCategory($slugCategory, $paramRequest)
    {
        $this->buildCondition($paramRequest, $condition, $sortBy, $sortType);
        $object = Post::query();
        $object->where($condition);
        if (!empty($slugCategory)) {
            $object->whereHas(
                'category',
                function (Builder $query) use ($slugCategory) {
                    $query->where('slug', $slugCategory)->orWhereHas(
                        'children',
                        function (Builder $query) use ($slugCategory) {
                            $query->where('slug', $slugCategory);
                        }
                    );
                }
            )->with('category.children');
        }
        $object->orderBy($sortBy, $sortType);
        $items = $object->paginate(config('constant.PAGE_NUMBER'));

        return $items;
    }
}
