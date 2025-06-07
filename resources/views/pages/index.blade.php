@extends('layouts.app')

@section('meta-description')

@section('title')

@section('content')
    <div class="container container--main home-layout">
        <section class="welcome-section">
            <div class="welcome-container">
                <h1 class="welcome-title">Добро пожаловать в SkyJett</h1>
                <p class="welcome-subtitle">Ваш надежный партнер для комфортных и безопасных путешествий по всему миру. Мы предлагаем высококлассный сервис, современный флот и гибкие тарифы.</p>
                <div class="welcome-btns">
                    <a href="{{ route('flights.index') }}" class="btn">Забронировать рейс</a>
                    <a href="{{ route('flights.index') }}" class="btn btn--white">Посмотреть маршруты</a>
                </div>
            </div>
        </section>
        <section class="app-section app-section--lg-gap advantages-section">
            <h2 class="section-title section-title--center">Наши преимущества</h2>
            <div class="cards-container">
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/star.svg" alt="звезда"></div>
                    <h3 class="title-3">Высокий уровень сервиса</h3>
                    <p class="card-subtitle">Профессиональный и внимательный персонал, готовый помочь вам в любой ситуации.</p>
                </div>
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/shield.svg" alt="щит"></div>
                    <h3 class="title-3">Безопасность</h3>
                    <p class="card-subtitle">Современный флот и строгое соблюдение всех стандартов безопасности.</p>
                </div>
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/money_bag.svg" alt="мешок денег"></div>
                    <h3 class="title-3">Выгодные тарифы</h3>
                    <p class="card-subtitle">Гибкая система тарифов и специальные предложения для постоянных клиентов.</p>
                </div>
            </div>
        </section>
        <section class="app-section app-section--bg-w popular-section">
            <h2 class="section-title section-title--center">Популярные маршруты</h2>
            <div class="cards-container">
                @if ($dbError)
                    <p style="text-align: center; color: #1e3a8a; font-size: 20px; font-weight: 700; margin: 30px auto; display: flex; align-items: center; gap: 10px;"><span style="font-size: 28px;">🚧</span>Ошибка сервера. Не удалось загрузить данные.<span style="font-size: 28px;">🚧</span></p>
                @else
                    @forelse($popularFlights as $flight)
                        <div class="cards-item cards-item--with-img cards-item--grid-3">
                            @php
                                $imagePath = $flight->image ? secure_asset('storage/' . $flight->image) : secure_asset('imgs/default-flight.webp');

                                $departure = \Carbon\Carbon::parse($flight->departure);
                                $arrival = \Carbon\Carbon::parse($flight->arrival);
                                $diffInMinutes = $departure->diffInMinutes($arrival);
                                $hours = floor($diffInMinutes / 60);
                                $minutes = $diffInMinutes % 60;

                                $departureDate = $departure->format('Y-m-d');
                                $arrivalDate = $arrival->format('Y-m-d');
                                $departureTime = $departure->format('H:i');
                                $arrivalTime = $arrival->format('H:i');
                            @endphp
                            <div class="card-img"><img src="{{ $imagePath }}" alt="{{ $flight->from }} — {{ $flight->to }}"></div>
                            <div class="card-content">
                                <div class="card-content-flex">
                                    <h3>{{ $flight->from }} — {{ $flight->to }}</h3>
                                    <span class="card-price">{{ $flight->price }} ₽</span>
                                </div>
                                <span class="card-time">
                                    {{ $departureDate }} • {{ $departureTime }} —
                                    @if ($arrivalDate !== $departureDate)
                                        {{ $arrivalDate }} • {{ $arrivalTime }}
                                    @else
                                        {{ $arrivalTime }}
                                    @endif
                                </span>
                                <a href="#more" class="btn">Подробнее</a>
                            </div>
                        </div>
                    @empty
                        <p style="text-align: center; font-weight: 700; margin: 30px auto;">Рейсов нет</p>
                    @endforelse
                @endif
                <!-- <div class="cards-item cards-item--with-img cards-item--grid-3">
                    <div class="card-img"><img src="imgs/flight1.webp" alt=""></div>
                    <div class="card-content">
                        <div class="card-content-flex">
                            <h3>Москва — Санкт-Петербург</h3>
                            <span class="card-price">5600 ₽</span>
                        </div>
                        <span class="card-time">2023-12-15 • 09:30 - 11:00</span>
                        <a href="#more" class="btn">Подробнее</a>
                    </div>
                </div>
                <div class="cards-item cards-item--with-img cards-item--grid-3">
                    <div class="card-img"><img src="imgs/flight2.webp" alt=""></div>
                    <div class="card-content">
                        <div class="card-content-flex">
                            <h3>Москва — Сочи</h3>
                            <span class="card-price">7800 ₽</span>
                        </div>
                        <span class="card-time">2023-12-16 • 12:45 - 15:15</span>
                        <a href="#more" class="btn">Подробнее</a>
                    </div>
                </div>
                <div class="cards-item cards-item--with-img cards-item--grid-3">
                    <div class="card-img"><img src="imgs/flight3.webp" alt=""></div>
                    <div class="card-content">
                        <div class="card-content-flex">
                            <h3>Санкт-Петербург - Калининград</h3>
                            <span class="card-price">6200 ₽</span>
                        </div>
                        <span class="card-time">2023-12-17 • 08:15 - 09:45</span>
                        <a href="#more" class="btn">Подробнее</a>
                    </div>
                </div> -->
            </div>
        </section>
        <section class="app-section app-section--lg-gap services-section">
            <h2 class="section-title section-title--center">Наши услуги</h2>
            <div class="cards-container">
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/people.svg" alt="люди"></div>
                    <h3 class="title-3">Пассажирские перевозки</h3>
                    <p class="card-subtitle">Комфортные перелеты для вас и вашей семьи с высоким уровнем сервиса.</p>
                    <a href="#more" class="link-btn">Подробнее →</a>
                </div>
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/box.svg" alt="коробка"></div>
                    <h3 class="title-3">Грузовые перевозки</h3>
                    <p class="card-subtitle">Быстрая и надежная доставка грузов в любую точку нашей маршрутной сети.</p>
                    <a href="#more" class="link-btn">Подробнее →</a>
                </div>
                <div class="cards-item cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/email.svg" alt="почта"></div>
                    <h3 class="title-3">Почтовые отправления</h3>
                    <p class="card-subtitle">Оперативная доставка почты и документов с гарантией сохранности.</p>
                    <a href="#more" class="link-btn">Подробнее →</a>
                </div>
            </div>
        </section>
        <section class="app-section contacts-section">
            <h2 class="section-title section-title--w section-title--center">Контактная информация</h2>
            <div class="cards-container">
                <div class="cards-item cards-item--no-bg cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/phone_w.svg" alt="телефон"></div>
                    <h3 class="title-3">Телефон</h3>
                    <a href="tel:+7 (800) 123-45-67" class="contacts-card-item">+7 (800) 123-45-67</a>
                    <p class="contacts-card-item">Ежедневно с 8:00 до 20:00</p>
                </div>
                <div class="cards-item cards-item--no-bg cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/email_w.svg" alt="почта"></div>
                    <h3 class="title-3">Email</h3>
                    <a href="mailto:info@skyjett.ru" class="contacts-card-item">info@skyjett.ru</a>
                    <a href="mailto:support@skyjett.ru" class="contacts-card-item">support@skyjett.ru</a>
                </div>
                <div class="cards-item cards-item--no-bg cards-item--grid-3">
                    <div class="card-icon"><img src="icons/main_page/office_w.svg" alt="офис"></div>
                    <h3 class="title-3">Офис</h3>
                    <p class="contacts-card-item">г. Москва, ул. Авиационная, 15</p>
                    <p class="contacts-card-item">Пн-Пт: 9:00 - 18:00</p>
                </div>
            </div>
        </section>
    </div>
@endsection