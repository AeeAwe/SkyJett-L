@extends('layouts.app')

@section('meta-description', 'Сравните доступные авиарейсы по вашему маршруту. Удобный фильтр, актуальные цены и быстрая бронь.')

@section('title', 'SkyJett — Каталог рейсов')

@section('content')
    <div class="container container--main">
        <section class="app-section app-section--flush flights-section">
            <h2 class="section-title">Каталог рейсов</h2>
            <section class="flights-filter">
                <div class="flights-filter-container">
                    <h3>Поиск и фильтрация</h3>
                    <div class="flights-filter-form">
                        <div class="filter-flex">
                            <div class="filter-item">
                                <label for="from">Откуда</label>
                                <input type="text" placeholder="Город вылета" id="from">
                            </div>
                            <div class="filter-item">
                                <label for="to">Куда</label>
                                <input type="text" placeholder="Город прилета" id="to">
                            </div>
                            <div class="filter-item">
                                <label for="date">Дата</label>
                                <input type="date" id="date" min="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="filter-flex">
                            <div class="filter-item">
                                <label for="type">Тип перевозки</label>
                                <select id="type">
                                    <option value="all">Все типы</option>
                                    <option value="passenger">Пассажирский</option>
                                    <option value="cargo">Грузовой</option>
                                    <option value="post">Почтовый</option>
                                </select>
                            </div>
                            <div class="filter-item">
                                <label for="class">Класс</label>
                                <select id="class">
                                    <option value="all">Все классы</option>
                                    <option value="first">Первый</option>
                                    <option value="business">Бизнес</option>
                                    <option value="economy">Эконом</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="flights-catalog">
                @if($dbError)
                    <p style="text-align: center; color: #1e3a8a; font-size: 20px; font-weight: 700; margin: 30px auto; display: flex; align-items: center; gap: 10px;"><span style="font-size: 28px;">🚧</span>Ошибка сервера. Не удалось загрузить данные.<span style="font-size: 28px;">🚧</span></p>
                @else
                    @forelse($flights as $flight)
                        <div class="flights-catalog-item">
                            <div class="flights-card">
                                @php
                                    $imagePath = $flight->image ? secure_asset('storage/' . $flight->image) : secure_asset('imgs/default-flight.webp');
                                @endphp

                                <div class="flights-card-img">
                                    <img src="{{ $imagePath }}" loading="lazy" alt="{{ $flight->from }} — {{ $flight->to }}">
                                </div>
                                <div class="flights-card-info">
                                    <div class="flights-info-flex">
                                        @php
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

                                        <div class="flights-info-flex flights-info-flex--col">
                                            <h3>{{ $flight->from }} — {{ $flight->to }}</h3>
                                            <span class="card-time">
                                                {{ $departureDate }} • {{ $departureTime }} —
                                                @if ($arrivalDate !== $departureDate)
                                                    {{ $arrivalDate }} • {{ $arrivalTime }}
                                                @else
                                                    {{ $arrivalTime }}
                                                @endif
                                            </span>
                                        </div>

                                        <span class="btn btn--light flights-info-inway">
                                            {{ $hours ? $hours . 'ч ' : '' }}{{ $minutes }}м
                                        </span>
                                    </div>
                                    <div class="flights-info-flex flights-info-flex--start">
                                        <span class="flights-class">{{ flightClassName($flight->class) }}</span>
                                    </div>
                                    <div class="flights-info-flex flights-info-flex--start">
                                        <span class="flights-type">Тип: Пассажирский</span>
                                        <span class="flights-type">Багаж: 23 кг</span>
                                    </div>
                                </div>
                                <div class="flights-card-actions">
                                    <div class="actions-flex">
                                        <span class="flights-price">{{ $flight->price }} ₽</span>
                                        <span class="flights-places">Осталось мест: 120</span>
                                    </div>
                                    <div class="actions-flex">
                                        <a href="#" class="btn">Подробнее</a>
                                        @auth
                                            @if(auth()->user()->role !== 'admin')
                                                <form action="{{ route('flights.book', $flight->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn--green">Забронировать</button>
                                                </form>
                                            @else
                                                <button class="btn btn--green" onclick="alert('Роль не позволяет бронировать рейс')">Забронировать</button>
                                            @endif
                                        @else
                                            <a href="{{ route('auth.index') }}" class="btn btn--green">Забронировать</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="text-align: center; font-weight: 700; margin: 30px 0;">Рейсов нет</p>
                    @endforelse
                @endif
            </section>

    </div>
@endsection