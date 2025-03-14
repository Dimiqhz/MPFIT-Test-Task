@extends('layouts.app')

@section('content')
    <h1>Редактировать товар</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Название товара:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Цена:</label>
            <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Обновить товар</button>
    </form>
@endsection
