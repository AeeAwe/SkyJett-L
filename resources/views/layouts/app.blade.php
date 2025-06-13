<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta-description', 'Удобный сервис для поиска и бронирования авиабилетов. Найдите лучшие предложения и начните своё путешествие уже сегодня.')">
    <title>@yield('title', 'SkyJett — Главная')</title>
    <link rel="icon" type="image/png" href="{{ secure_asset('/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ secure_asset('/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ secure_asset('/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="SkyJett" />
    <link rel="manifest" href="{{ secure_asset('/site.webmanifest') }}" />
    <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}">
    @auth
        @if(auth()->user()->role === 'admin')
            <link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
        @endif
    @endauth
    <script src="{{ secure_asset('js/script.js') }}"></script>
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