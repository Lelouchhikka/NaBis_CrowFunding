@extends('layouts.app')

@section('content')
    <h1>Редактировать проект</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Поля формы для редактирования проекта -->

        <div class="form-group">
            <label for="title">Название:</label>
            <input type="text" name="title" id="title" value="{{ $project->title }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="goal">Цель:</label>
            <input type="text" name="goal" id="goal" value="{{ $project->goal }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="deadline">Дедлайн:</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline ?? date('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="photo">Фотография:</label>
            <input type="file" name="photo" id="photo" class="form-control-file">
            @if ($project->photo)
                <img src="{{ asset('storage/' . $project->photo) }}" alt="Current Photo" style="max-width: 200px;">
            @endif
        </div>

        <div class="form-group">
            <label for="video">Видео:</label>
            <input type="text" name="video" id="video" value="{{ $project->video }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="type_id">Тип проекта:</label>
            <select name="type_id" id="type_id" class="form-control">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

    <form action="{{ route('projects.destroy', $project) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
@endsection
