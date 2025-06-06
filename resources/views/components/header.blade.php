<header class="app-header">
    <div class="container container--header">
        <a href="{{ route('home') }}" class="app-logo"><img src="{{ asset('icons/logo_w.svg') }}" alt="SkyJett — логотип"></a>
        <div class="header-actions">
            <nav class="header-nav">
                <a href="{{ route('home') }}">Главная</a>
                <a href="{{ route('flights.index') }}">Каталог рейсов</a>
                <a href="#services">Услуги</a>
                <a href="#reviews">Отзывы</a>
                @auth
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.users') }}">Админ</a>
                    @endif
                @endauth
            </nav>
            @auth
                <a href="{{ route('profile.index') }}" class="btn btn--profile">Профиль</a>
            @endauth
            @guest
                <a href="{{ route('auth.index') }}" class="btn btn--profile">Войти</a>
            @endguest
        </div>
        <div class="header-burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>