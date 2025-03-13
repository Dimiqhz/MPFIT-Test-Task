<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderStatusUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Class OrderController
 *
 * Контроллер для управления заказами
 */
class OrderController extends Controller
{
    /**
     * Отображает список заказов с вычислением итоговой цены
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with('product')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Показывает форму для создания нового заказа
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Сохраняет новый заказ в базе данных
     *
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderStoreRequest $request)
    {
        Order::create($request->validated());
        return redirect()->route('orders.index')
                         ->with('success', 'Заказ успешно создан');
    }

    /**
     * Отображает детальную информацию о заказе с возможностью смены статуса
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->load('product');
        return view('orders.show', compact('order'));
    }

    /**
     * Обновляет статус заказа (на 'new' или 'completed')
     *
     * @param OrderStatusUpdateRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(OrderStatusUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());
        return redirect()->route('orders.show', $order)
                         ->with('success', 'Статус заказа обновлён');
    }
}
