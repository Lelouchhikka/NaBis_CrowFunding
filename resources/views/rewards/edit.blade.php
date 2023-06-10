@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать вознаграждение</h1>

        <form action="{{ route('rewards.update', ['reward' => $reward->id, 'project' => $reward->project_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Поля формы для редактирования вознаграждения -->
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $reward->title }}">
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea name="description" id="description" class="form-control">{{ $reward->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="min_contribution">Минимальный вклад:</label>
                <input type="text" name="min_contribution" id="min_contribution" class="form-control" value="{{ $reward->min_contribution }}">
            </div>

            <div class="form-group">
                <label for="max_backers">Максимальное количество участников:</label>
                <input type="text" name="max_backers" id="max_backers" class="form-control" value="{{ $reward->max_backers }}">
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>

        <form action="{{ route('rewards.destroy', ['project' => $reward->project_id, 'reward' => $reward->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reward?')">Удалить</button>
        </form>
    </div>
@endsection
