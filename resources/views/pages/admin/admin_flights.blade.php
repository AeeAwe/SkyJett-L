@extends('layouts.app')

@section('meta-description', 'Просматривайте и управляйте рейсами и пользователями')

@section('title', 'SkyJett — Админ')

@section('content')
    <div class="container container--main">
        @include('components.admin-links')
        <h1>Рейсы</h1>

        <a href="{{ route('admin.flights.create') }}" class="btn">Добавить новый рейс</a>

        @foreach ($flights as $flight)
            <div class="admin-card">
                <div>
                    <h3>{{ $flight->from }} → {{ $flight->to }}</h3>
                    <p><strong>Вылет:</strong> {{ $flight->departure }}</p>
                    <p><strong>Прилет:</strong> {{ $flight->arrival }}</p>
                    <p><strong>Класс:</strong> {{ flightClassName($flight->class) }}</p>
                    <p><strong>Цена:</strong> {{ $flight->price }} ₽</p>
                    <p><strong>Описание:</strong> {{ $flight->description ?? "Отсутствует" }}</p>
                </div>

                <div class="admin-card-btns">
                    <a href="{{ route('admin.flights.edit', $flight->id) }}" class="btn btn--light">Редактировать</a>
                    <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn--red">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection