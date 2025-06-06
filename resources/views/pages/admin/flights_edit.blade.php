@extends('layouts.app')

@section('title', 'Редактировать рейс')

@section('content')
    <div class="container container--main">
        @include('components.admin-links')
        <div class="admin-create_edit-box">
            <h1>Редактировать рейс</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.flights.update', $flight->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf
                @method('PUT')
                <div>
                    <label>Откуда</label>
                    <input type="text" name="from" value="{{ old('from', $flight->from) }}" required>
                    @error('from') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Куда</label>
                    <input type="text" name="to" value="{{ old('to', $flight->to) }}" required>
                    @error('to') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Описание</label>
                    <textarea name="description">{{ old('description', $flight->description) }}</textarea>
                    @error('description') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Дата и время вылета</label>
                    <input type="datetime-local"
                        name="departure"
                        value="{{ old('departure', \Carbon\Carbon::parse($flight->departure)->format('Y-m-d\TH:i')) }}"
                        min="{{ now()->format('Y-m-d\TH:i') }}"
                        required>
                    @error('departure') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Дата и время прибытия</label>
                    <input type="datetime-local"
                        name="arrival"
                        value="{{ old('arrival', \Carbon\Carbon::parse($flight->arrival)->format('Y-m-d\TH:i')) }}"
                        required>
                    @error('arrival') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Класс</label>
                    <select name="class" required>
                        <option value="economy" @selected(old('class', $flight->class) === 'Эконом')>Эконом</option>
                        <option value="business" @selected(old('class', $flight->class) === 'Бизнес')>Бизнес</option>
                        <option value="first" @selected(old('class', $flight->class) === 'Первый')>Первый</option>
                    </select>
                    @error('class') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Цена</label>
                    <input type="number" name="price" value="{{ old('price', $flight->price) }}" required>
                    @error('price') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Текущее изображение</label>
                    @if($flight->image)
                        <img src="{{ asset('storage/' . $flight->image) }}" alt="Изображение рейса" width="200" borderRadius="15px">
                    @else
                        <p style="color: #a6a6a6;">Нет изображения</p>
                    @endif
                </div>
                <div>
                    <label>Заменить изображение</label>
                    <input type="file" name="image" accept="image/*">
                    @error('image') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <button type="submit" class="btn">Сохранить изменения</button>
                    <a href="{{ route('admin.flights') }}" class="btn btn--white">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
