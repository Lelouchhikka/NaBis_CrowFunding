@extends('layouts.app')

@section('title', 'Projects by Type')

@section('content')
    <h1>Projects of Type: {{ $type->name }}</h1>

    @if ($projects->count() > 0)
        <div class="card-grid">
            @foreach($projects as $project)
                <div class="card">
                    <img src="{{ asset('storage/' . $project->photo) }}" class="card-img-top" alt="Изображение проекта">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($project->current_amount / $project->goal) * 100 }}%" aria-valuenow="{{ $project->current_amount }}" aria-valuemin="0" aria-valuemax="{{ $project->goal }}"></div>
                        </div>
                        <p class="card-text">Goal: ${{ $project->goal }}</p>
                        <p class="card-text">Current Amount: ${{ $project->current_amount }}</p>

                        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No projects found.</p>
    @endif
@endsection
