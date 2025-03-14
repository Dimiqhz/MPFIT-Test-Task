@extends('layouts.app')

@section('content')
    <h1>Создать заказ</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div>
            <label for="product_id">Товар:</label>
            <select name="product_id" id="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} - {{ $product->price }} руб.
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="buyer_full_name">ФИО покупателя:</label>
            <input type="text" name="buyer_full_name" id="buyer_full_name" value="{{ old('buyer_full_name') }}">
            @error('buyer_full_name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="quantity">Количество:</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}">
            @error('quantity')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="comment">Комментарий:</label>
            <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
            @error('comment')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Сохранить заказ</button>
    </form>
@endsection
