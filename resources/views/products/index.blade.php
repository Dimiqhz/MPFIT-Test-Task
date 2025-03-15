@extends('layouts.app')

@section('content')
    <h1>Список товаров</h1>
    <a href="{{ route('products.create') }}">Добавить товар</a>
    <ul>
        @foreach ($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                - Цена: {{ $product->price }} руб.
                - Категория: {{ $product->category->name }}
                <a href="{{ route('products.edit', $product) }}">Редактировать</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
    
    {{-- Вывод ссылок пагинации --}}
    {{ $products->links() }}
@endsection
