<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Главная</a></li>
                <li><a href="{{ route('products.index') }}">Товары</a></li>
                <li><a href="{{ route('orders.index') }}">Заказы</a></li>
                <li><a href="{{ route('categories.index') }}">Категории</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Магазин. Все права защищены.</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>