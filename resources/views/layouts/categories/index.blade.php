@extends('layouts.app')

@section('content')
    <h1>Список категорий</h1>
    <a href="{{ route('categories.create') }}">Добавить категорию</a>
    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
@endsection
