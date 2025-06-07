@extends('layouts.app')

@section('meta-description', 'Войдите в свой аккаунт или зарегистрируйтесь, чтобы быстро бронировать рейсы и управлять своими заказами.')

@section('title', 'SkyJett — Вход')

@section('extra-scripts')
    <script src="{{ secure_asset("js/auth.js") }}"></script>
@endsection

@section('content')
    <div class="container container--auth">
        <section class="auth-section">
            <a href="{{ route('home') }}" class="link-btn">← На главную</a>
            <div class="auth-container">
                <div class="auth-toggle">
                    <button class="auth-toggle-item sign-in {{ session('activeTab') === 'register' ? '' : 'active' }}">Вход</button>
                    <button class="auth-toggle-item sign-up {{ session('activeTab') !== 'register' ? '' : 'active' }}">Регистрация</button>
                </div>
                <form method="POST" action="{{ route('auth.login') }}" class="auth-form login {{ session('activeTab') !== 'register' ? '' : 'hidden' }}">
                    @csrf
                    <div class="auth-flex-col">
                        <label for="login-email">Email</label>
                        <input type="email" placeholder="your@email.com" value="{{ session('activeTab') !== 'register' ?  old('email') : '' }}" id="login-email" name="email" autocomplete="email" required>
                    </div>
                    <div class="auth-flex-col">
                        <label for="login-password">Пароль</label>
                        <input type="password" placeholder="••••••••" id="login-password" name="password" autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn">Войти</button>
                </form>
                <form method="POST" action="{{ route('auth.register') }}" class="auth-form register {{ session('activeTab') === 'register' ? '' : 'hidden' }}">
                    @csrf
                    <div class="auth-flex-col">
                        <label for="register-name">Имя</label>
                        <input type="text" placeholder="Иван Иванович" value="{{ old('name') }}" id="register-name" name="name" autocomplete="name" required>
                    </div>
                    <div class="auth-flex-col">
                        <label for="register-email">Email</label>
                        <input type="email" placeholder="your@email.com" value="{{ session('activeTab') === 'register' ? old('email') : '' }}" id="register-email" name="email" autocomplete="email" required>
                    </div>
                    <div class="auth-flex-col">
                        <label for="register-phone">Телефон</label>
                        <input type="tel" placeholder="+7 (999) 123-45-67" value="{{ old('phone') }}" id="register-phone" name="phone" autocomplete="tel" required>
                    </div>
                    <div class="auth-flex-col">
                        <label for="register-password">Пароль</label>
                        <input type="password" placeholder="••••••••" id="register-password" name="password" autocomplete="new-password" required>
                    </div>
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>
                @if ($errors->any())
                    <ul style="margin: 0; list-style: none; font-weight: 700;">
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>
    </div>
@endsection