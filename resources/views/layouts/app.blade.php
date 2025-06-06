<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-description', 'Удобный сервис для поиска и бронирования авиабилетов. Найдите лучшие предложения и начните своё путешествие уже сегодня.')">
    <title>@yield('title', 'SkyJett — Главная')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @auth
        @if(auth()->user()->role === 'admin')
            <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        @endif
    @endauth
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('extra-scripts')
</head>
<body>
    <div class="app">
        @include('components.header')
    
        <main class="app-main">
            @yield('content')
        </main>
    
        @include('components.footer')
    </div>
</body>
</html>