<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @group Product
 *
 * @package App\Http\Controllers\Api
 */
final class ProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get list
     *
     * @bodyParam keyword  Example: title
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $params = $request->only('keyword');

        $object = Product::query();

        if (!empty($params['keyword'])) {
            $object->where('title', 'like', $params['keyword'] . '%');
            $object->orWhere('sku', 'like', $params['keyword'] . '%');
        }

        $column = ['id', 'sku', 'title', 'price', 'price_promotion'];

        return $object->orderBy('id', 'desc')->select($column)->paginate(20);
    }

    /**
     * Create
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * Display
     *
     * @param int $id
     *
     * @return void
     */
    public function show($id)
    {
    }

    /**
     * Update
     *
     * @param Request $request
     * @param int $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
    }
}
