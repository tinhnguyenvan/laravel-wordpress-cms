<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

/**
 * Class ProductController.
 *
 * @property ProductService $productService
 */
final class ProductController extends SiteController
{
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    public function index(Request $request, $slugCategory = '')
    {
        $items = $this->productService->getProductBySlugCategory($slugCategory, $request->all());

        $productCategory = ProductCategory::query()->where('slug', $slugCategory)->first();
        if (empty($productCategory)) {
            $productCategory = (object) [
                'title' => trans('layout_product1.category'),
            ];

            $this->productService->buildCondition($request->all(), $condition, $sortBy, $sortType);
            $items = Product::query()->where($condition)->orderBy($sortBy, $sortType)->paginate(config('constant.PAGE_NUMBER'));
        }

        $data = [
            'productCategory' => $productCategory,
            'items' => $items,
            'title' => $productCategory->title,
            'error' => session('error'),
        ];

        return view($this->layout.'product.index', $this->render($data));
    }

    public function view(Request $request, $slugCategory, $slugProduct)
    {
        $product = Product::query()->where('slug', $slugProduct)->first();

        if (empty($product)) {
            return redirect(base_url('404.html'));
        }

        Product::query()->increment('views');

        $items = Product::query()->where(['category_id' => $product->category_id])->orderByDesc('id')->paginate($this->page_number);
        $productCategory = ProductCategory::query()->where('slug', $slugCategory)->first();

        $data = [
            'title' => $product->title,
            'product' => $product,
            'productCategory' => $productCategory,
            'items' => $items,
        ];

        return view($this->layout.'product.view', $this->render($data));
    }
}
