<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */
namespace App\Services;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\PostTranslation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
                'category_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        foreach (Language::loadLanguage() as $code => $languageName) {
            // slug
            if (empty($formData['slug'])) {
                $slug = $formData[$code]['title'] ?? '';
            } else {
                $slug = $formData['slug'];
            }

            $slug = Str::slug($slug);
            if ($isNews) {
                $myPost = PostTranslation::query()->where('locale', $code)->where('slug', $slug)->first();
                if (!empty($myPost->slug)) {
                    $slug .= '-' . rand(0, 1000);
                }
            }

            $formData[$code]['slug'] = $slug;
        }

        unset($formData['slug']);

        if ($isNews) {
            $formData['creator_id'] = Auth::id() ?? 0;
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
    public function filter(array $params = [])
    {
        $active = [
            'category_id' => $params['category_id'] ?? 0,
            'status' => $params['status'] ?? 0,
        ];

        $category = PostCategory::all('id', 'title')->toArray();

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
    }

    /**
     * @param $limit
     *
     * @return object
     */
    public static function newest($limit = 5): object
    {
        return Post::active()->orderByRaw('id desc')->get()->take($limit);
    }

    public function getPostBySlugCategory($slugCategory, $paramRequest): LengthAwarePaginator
    {
        $this->buildCondition($paramRequest, $condition, $sortBy, $sortType);
        $object = Post::query()->with(['comment']);
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

        return $object->paginate(config('constant.PAGE_NUMBER'));
    }
}
