@extends('layouts.app')

@section('content')
    <h1>Список заказов</h1>
    <a href="{{ route('orders.create') }}">Создать заказ</a>
    <ul>
        @foreach ($orders as $order)
            <li>
                Заказ №{{ $order->id }} - Дата: {{ $order->created_at->format('d.m.Y H:i') }}
                - Покупатель: {{ $order->buyer_full_name }}
                - Статус: {{ $order->status }}
                - Итоговая цена: {{ $order->total_price }} руб.
                <a href="{{ route('orders.show', $order) }}">Детали</a>
            </li>
        @endforeach
    </ul>
@endsection
