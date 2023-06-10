@extends('layouts.app')

@section('content')
    <h1>Редактировать проект</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Поля формы для редактирования проекта -->

        <div>
            <label for="title">Название:</label>
            <input type="text" name="title" id="title" value="{{ $project->title }}">
        </div>

        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description">{{ $project->description }}</textarea>
        </div>

        <div>
            <label for="goal">Цель:</label>
            <input type="text" name="goal" id="goal" value="{{ $project->goal }}">
        </div>

        <div>
            <label for="deadline">Дедлайн:</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline ?? date('Y-m-d') }}">
        </div>

        <div>
            <label for="photo">Фотография:</label>
            <input type="file" name="photo" id="photo">
        </div>

        <div>
            <label for="video">Видео:</label>
            <input type="text" name="video" id="video" value="{{ $project->video }}">
        </div>

        <div>
            <label for="type_id">Тип проекта:</label>
            <select name="type_id" id="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Обновить</button>
    </form>

    <form action="{{ route('projects.destroy', $project) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Удалить</button>
    </form>
@endsection
