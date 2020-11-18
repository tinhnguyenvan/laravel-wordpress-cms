<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\ProductCategory;
use App\Models\RolePermission;
use App\Services\MediaService;
use App\Services\ProductCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class ProductCategoryController.
 *
 * @property ProductCategoryService $productCategoryService
 * @property MediaService $mediaService
 */
class ProductCategoryController extends AdminController
{
    public function __construct(ProductCategoryService $productCategoryService, MediaService $mediaService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::PRODUCT_SHOW]);
        $this->productCategoryService = $productCategoryService;
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $this->productCategoryService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = ProductCategory::query()->where($condition)->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')->get();

        $data = [
            'items' => $items,
        ];

        return view('admin/product_category/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdownCategory' => $this->productCategoryService->dropdown(),
            'product_category' => new ProductCategory(),
        ];

        return view('admin/product_category/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->productCategoryService->create($params);
            if (empty($result['message'])) {
                // image
                if ($request->hasFile('file')) {
                    $this->mediaService->uploadModule(
                        [
                            'file' => $request->file('file'),
                            'object_type' => Media::OBJECT_TYPE_PRODUCT_CATEGORY,
                            'object_id' => $result['id'],
                        ]
                    );
                }

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('product_categories'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('product_categories/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdownCategory' => $this->productCategoryService->dropdown(),
            'product_category' => ProductCategory::query()->findOrFail($id),
        ];

        return view('admin/product_category/form', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            // remove image
            if (!empty($params['file_remove'])) {
                $params['image_id'] = 0;
                $params['image_url'] = '';
            }

            $result = $this->productCategoryService->update($id, $params);

            if (empty($result['message'])) {
                // image
                if ($request->hasFile('file')) {
                    $this->mediaService->uploadModule(
                        [
                            'file' => $request->file('file'),
                            'object_type' => Media::OBJECT_TYPE_PRODUCT_CATEGORY,
                            'object_id' => $id,
                        ]
                    );
                }

                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('product_categories'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = ProductCategory::query()->findOrFail($id);
        $countChild = ProductCategory::query()->where(['parent_id' => $id])->count();
        if (!empty($myObject->id) && 0 == $countChild) {
            ProductCategory::destroy($id);
        }

        if ($countChild > 0) {
            $request->session()->flash('error', trans('common.delete.exist.child'));
        } else {
            $request->session()->flash('success', trans('common.delete.success'));
        }

        return redirect(admin_url('product_categories'));
    }
}
