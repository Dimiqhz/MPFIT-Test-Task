@extends('layouts.app')

@section('content')
    <h1>Добавить товар</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Название товара:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Цена:</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection
