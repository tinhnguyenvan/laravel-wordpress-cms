<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Services\MediaService;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @property ProductService         $productService
 * @property ProductCategoryService $productCategoryService
 * @property MediaService           $mediaService
 */
class ProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $params = $request->only('keyword');

        $object = Product::query();

        if (! empty($params['keyword'])) {
            $object->where('title', 'like', $params['keyword'].'%');
            $object->orWhere('sku', 'like', $params['keyword'].'%');
        }

        $column = ['id', 'sku', 'title', 'price', 'price_promotion'];
        return $object->orderBy('id', 'desc')->select($column)->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    }
}
