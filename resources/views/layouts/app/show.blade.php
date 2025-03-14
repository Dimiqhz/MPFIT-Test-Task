@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p><strong>Категория:</strong> {{ $product->category->name }}</p>
    <p><strong>Описание:</strong> {{ $product->description }}</p>
    <p><strong>Цена:</strong> {{ $product->price }} руб.</p>
    <a href="{{ route('products.edit', $product) }}">Редактировать</a>
    <a href="{{ route('products.index') }}">Вернуться к списку</a>
@endsection
