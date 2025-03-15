<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

/**
 * Class ProductController
 *
 * Реализует REST API для управления товарами.
 */
class ProductController extends Controller
{
    /**
     * Возвращает список всех товаров с информацией о категории.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('category')) {
            $query->where('category_id', $request->get('category'));
        }

        // Пагинация: 10 товаров на странице
        $products = $query->paginate(10);

        return response()->json($products);
    }

    /**
     * Возвращает детальную информацию о конкретном товаре.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        $product->load('category');
        return response()->json($product);
    }

    /**
     * Создаёт новый товар.
     *
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Обновляет данные товара.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Удаляет товар.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
