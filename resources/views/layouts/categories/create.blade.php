@extends('layouts.app')

@section('content')
    <h1>Добавить категорию</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Название категории:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Сохранить категорию</button>
    </form>
@endsection
