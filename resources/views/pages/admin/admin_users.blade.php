@extends('layouts.app')

@section('meta-description', 'Просматривайте и управляйте рейсами и пользователями')

@section('title', 'SkyJett — Админ')

@section('content')
    <div class="container container--main">
        @include('components.admin-links')
        <h1>Пользователи</h1>
        
        @foreach ($users as $user)
            <div class="admin-card">
                <div>
                    <h3>{{ $user->name }}</h3>
                    <p><strong>Почта:</strong> {{ $user->email }}</p>
                    <p><strong>Телефон:</strong> {{ $user->phone }}</p>
                    <p><strong>Роль:</strong> {{ $user->role }}</p>
                </div>

                <div class="admin-card-btns">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn--red">Удалить пользователя</button>
                    </form>
                </div>

                @if ($user->bookings->count())
                    <details>
                        <summary>Бронирования ({{ $user->bookings->count() }})</summary>
                        <ul>
                            @foreach ($user->bookings as $booking)
                                <li>
                                    Рейс: {{ $booking->flight->from }} — {{ $booking->flight->to }} ({{ $booking->status }})
                                    <form action="{{ route('admin.booking.destroy', [$user,$booking]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn--light">Удалить</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                @endif
            </div>
        @endforeach
    </div>
@endsection