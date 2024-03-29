<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Nav;
use App\Models\Page;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Validator;
use TinhPHP\Woocommerce\Models\ProductCategory;

/**
 * Class NavService.
 *
 * @property Nav $navs
 */
class NavService extends BaseService
{
    public function __construct(Nav $navs)
    {
        parent::__construct();
        $this->model = $navs;
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
            'title' => 'required|min:2|max:255',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        $formData['value'] = $this->convertValueByType($formData['type'], $formData);

        if (empty($formData['parent_id'])) {
            $formData['level'] = 0;
        } else {
            $myObject = Nav::query()->find($formData['parent_id']);
            $formData['level'] = $myObject->level + 1;
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

        $this->beforeSave($params);
        $myObject = new Nav($params);

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

        return Nav::query()->findOrFail($id)->update($params);
    }

    /**
     * @return array
     */
    public function dropdown()
    {
        $data = Nav::all();
        $html = [];
        if (!empty($data)) {
            foreach ($data as $key => $myCategory) {
                $html[$myCategory->id] = $myCategory->title;
            }
        }

        return $html;
    }

    public function convertValueByType($type, $formData)
    {
        $value = '';

        switch ($type) {
            case Nav::TYPE_LINK:
                $value = $formData['type_link'] ?? '';
                break;
            case Nav::TYPE_PAGE:
                $data = Page::query()->findOrFail($formData['type_page']);
                if (!empty($data->id)) {
                    $value = $data->link;
                }
                break;

            case Nav::TYPE_CATEGORY_POST:
                $data = PostCategory::query()->findOrFail($formData['type_category_post']);
                if (!empty($data->id)) {
                    $value = $data->link;
                }
                break;

            case Nav::TYPE_CATEGORY_PRODUCT:
                $data = ProductCategory::query()->findOrFail($formData['type_category_product']);
                if (!empty($data->id)) {
                    $value = $data->link;
                }
                break;
        }

        return $value;
    }

    /**
     * @return array
     */
    public function dropdownProductCategory(): array
    {
        $data = ProductCategory::query()
            ->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')
            ->get();

        $html = [];
        if (!empty($data)) {
            foreach ($data as $key => $myCategory) {
                $html[$myCategory->id] = create_line($myCategory->level) . ' ' . $myCategory->title;
            }
        }

        return $html;
    }
}
