<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderStatusUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Подключаем логгер

/**
 * Class OrderController
 *
 * Контроллер для управления заказами.
 */
class OrderController extends Controller
{
    /**
     * Отображает список заказов с вычислением итоговой цены.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::with('product');

        // Фильтрация по статусу заказа, если передан параметр
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        // Пагинация: 10 заказов на страницу
        $orders = $query->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Показывает форму для создания нового заказа.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Сохраняет новый заказ в базе данных.
     *
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderStoreRequest $request)
    {
        $order = Order::create($request->validated());
        Log::info('Заказ создан', ['order_id' => $order->id, 'buyer' => $order->buyer_full_name]);
        return redirect()->route('orders.index')
                         ->with('success', 'Заказ успешно создан');
    }

    /**
     * Отображает детальную информацию о заказе с возможностью смены статуса.
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
     * Обновляет статус заказа (на 'new' или 'completed').
     *
     * @param OrderStatusUpdateRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(OrderStatusUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());
        Log::info('Статус заказа обновлён', ['order_id' => $order->id, 'status' => $order->status]);
        return redirect()->route('orders.show', $order)
                         ->with('success', 'Статус заказа обновлён');
    }
}
