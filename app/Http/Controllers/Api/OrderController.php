<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderStatusUpdateRequest;
use App\Models\Order;

/**
 * Class OrderController
 *
 * Реализует REST API для управления заказами.
 */
class OrderController extends Controller
{
    /**
     * Возвращает список всех заказов с информацией о товаре.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Order::with('product');

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        $orders = $query->paginate(10);

        return response()->json($orders);
    }

    /**
     * Возвращает детальную информацию о конкретном заказе.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        $order->load('product');
        return response()->json($order);
    }

    /**
     * Создаёт новый заказ.
     *
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStoreRequest $request)
    {
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    /**
     * Обновляет статус заказа.
     *
     * @param OrderStatusUpdateRequest $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderStatusUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());
        return response()->json($order);
    }

    /**
     * Удаляет заказ.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
