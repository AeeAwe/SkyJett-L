@extends('layouts.app')

@section('title', 'Создать рейс')

@section('content')
    <div class="container container--main">
        @include('components.admin-links')
        <div class="admin-create_edit-box">
            <h1>Добавить новый рейс</h1>
            <form action="{{ route('admin.flights.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf
                <div>
                    <label>Откуда:</label>
                    <input type="text" name="from" required>
                    @error('from') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Куда:</label>
                    <input type="text" name="to" required>
                    @error('to') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Описание:</label>
                    <textarea name="description"></textarea>
                    @error('description') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Дата вылета:</label>
                    <input type="datetime-local" name="departure" value="{{ old('departure') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                    @error('departure') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Дата прибытия:</label>
                    <input type="datetime-local" name="arrival" value="{{ old('departure') }}" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                    @error('arrival') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Класс:</label>
                    <select name="class" required>
                        <option value="economy">Эконом</option>
                        <option value="business">Бизнес</option>
                        <option value="first">Первый</option>
                    </select>
                    @error('class') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Цена:</label>
                    <input type="number" name="price" required>
                    @error('price') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Изображение:</label>
                    <input type="file" name="image">
                    @error('image') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <button type="submit" class="btn">Сохранить</button>
                    <a href="{{ route('admin.flights') }}" class="btn btn--white">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
