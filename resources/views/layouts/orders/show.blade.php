@extends('layouts.app')

@section('content')
    <h1>Заказ №{{ $order->id }}</h1>
    <p><strong>Дата заказа:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
    <p><strong>Покупатель:</strong> {{ $order->buyer_full_name }}</p>
    <p>
        <strong>Товар:</strong> {{ $order->product->name }} -
        Цена: {{ $order->product->price }} руб.
    </p>
    <p><strong>Количество:</strong> {{ $order->quantity }}</p>
    <p><strong>Итоговая цена:</strong> {{ $order->total_price }} руб.</p>
    <p><strong>Статус:</strong> {{ $order->status }}</p>
    <p><strong>Комментарий:</strong> {{ $order->comment }}</p>

    <h3>Изменить статус заказа</h3>
    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status">
            <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>Новый</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Выполнен</option>
        </select>
        <button type="submit">Обновить статус</button>
    </form>
@endsection
