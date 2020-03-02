<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\Product;
use App\Models\RolePermission;
use App\Services\MediaService;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ProductController.
 *
 * @property ProductService         $productService
 * @property ProductCategoryService $productCategoryService
 * @property MediaService           $mediaService
 */
class ProductController extends AdminController
{
    public function __construct(
        ProductService $productService,
        ProductCategoryService $productCategoryService,
        MediaService $mediaService
    ) {
        parent::__construct();
        $this->middleware(['permission:'.RolePermission::PRODUCT_SHOW]);

        $this->mediaService = $mediaService;
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->productService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Product::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $filter = $this->productService->filter($request->all());

        $data = [
            'filter' => $filter,
            'items' => $items,
            'error' => session('error'),
        ];

        return view('admin/product.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'product' => new Product(),
            'dropdownCategory' => $this->productCategoryService->dropdown(),
        ];

        return view('admin/product.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (! empty($params['_token'])) {
            $result = $this->productService->create($params);

            if (empty($result['message'])) {
                $this->mediaService->uploadModule([
                    'file' => $request->file('file'),
                    'object_type' => Media::OBJECT_TYPE_PRODUCT,
                    'object_id' => $result['id'],
                ]);

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('products'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('products/'.$id.'/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdownCategory' => $this->productCategoryService->dropdown(),
            'product' => Product::query()->findOrFail($id),
        ];

        return view('admin/product.form', $this->render($data));
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        if (! empty($params['_token'])) {
            $result = $this->productService->update($id, $params);

            if (empty($result['message'])) {
                $this->mediaService->uploadModule([
                    'file' => $request->file('file'),
                    'object_type' => Media::OBJECT_TYPE_PRODUCT,
                    'object_id' => $id,
                ]);

                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('products'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Product::query()->findOrFail($id);

        if (! empty($myObject->id)) {
            Product::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('products'));
    }

    /**
     * delete multi.
     *
     * @return RedirectResponse
     */
    public function destroyMulti(Request $request)
    {
        $params = $request->all();

        if (! empty($params['ids'])) {
            $items = Product::query()->whereIn('id', $params['ids'])->get();
            foreach ($items as $item) {
                $item->delete();
            }
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.error_check_ids'));
        }

        return back();
    }
}
