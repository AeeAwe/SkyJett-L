@extends('layouts.app')

@section('meta-description', 'Профиль с информацией о вас и ваших бронированиях.')

@section('title', 'SkyJett — Профиль')

@section('content')
    <div class="container container--main">
        <section class="profile-section">
            <h2 class="section-title">Личный кабинет</h2>
            <div class="profile-grid-container">
                <div class="grid-item grid-item-span-1">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="profile-img"></div>
                            <h3 class="profile-name">{{ $user->name }}</h3>
                            <div class="profile-id">
                                @if ($user->role === 'admin')
                                    Админ
                                @else
                                    {{ $user->email }}
                                @endif
                            </div>
                        </div>
                        <div class="profile-card-data">
                            <div class="profile-data-flex">
                                <label for="email">Email:</label>
                                <span id="email">{{ $user->email }}</span>
                            </div>
                            <div class="profile-data-flex">
                                <label for="phone">Телефон:</label>
                                <span id="phone">{{ $user->phone ?? '-' }}</span>
                            </div>
                            <div class="profile-data-flex">
                                <label for="book">Бронирований:</label>
                                <span id="book">{{ $bookings->count() }}</span>
                            </div>
                        </div>
                        <div class="profile-card-actions">
                            <button class="btn" onclick="alert('Функция в разработке')">Редактировать профиль</button>
                            <form action="{{ route('profile.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn--light">Выйти из аккаунта</button>
                            </form>
                            <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Удалить аккаунт?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn--red">Удалить аккаунт</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="grid-item-span-2">
                    <div class="grid-item grid-card">
                        <h3>Мои бронирования</h3>
                        <div class="book-data">
                            @forelse($bookings as $booking)
                                <div class="booking-item">
                                    @php
                                        $departure = \Carbon\Carbon::parse($booking->flight->departure);
                                        $arrival = \Carbon\Carbon::parse($booking->flight->arrival);
                                        $diffInMinutes = $departure->diffInMinutes($arrival);
                                        $hours = floor($diffInMinutes / 60);
                                        $minutes = $diffInMinutes % 60;

                                        $departureDate = $departure->format('Y-m-d');
                                        $arrivalDate = $arrival->format('Y-m-d');
                                        $departureTime = $departure->format('H:i');
                                        $arrivalTime = $arrival->format('H:i');
                                    @endphp
                                    <p><strong>Рейс:</strong> {{ $booking->flight->from }} — {{ $booking->flight->to }} ({{ $booking->status }})</p>
                                    <p><strong>Дата:</strong> 
                                    {{ $departureDate }} • {{ $departureTime }} -
                                        @if ($arrivalDate !== $departureDate)
                                            {{ $arrivalDate }} {{ $arrivalTime }}
                                        @else
                                            {{ $arrivalTime }}
                                        @endif
                                    </p>
                                    <form action="{{ route('booking.destroy', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn--red">Удалить</button>
                                    </form>
                                </div>
                            @empty
                                <div class="nothing">
                                    <span>❌</span>
                                    <h4>У вас пока нет бронирований</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="grid-item grid-card">
                        <h3>Мои отзывы</h3>
                        <div class="reviews-data">
                            @forelse($reviews as $review)
                                <div class="review-item">
                                    <p><strong>{{ $review->title }}</strong></p>
                                    <p>{{ $review->body }}</p>
                                    <small>Оставлен: {{ $review->created_at->format('d.m.Y') }}</small>
                                </div>
                            @empty
                                <div class="nothing">
                                    <span>❌</span>
                                    <h4>Функция в разработке</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection