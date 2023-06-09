@extends('layouts.app')

@section('title', 'Crowdfunding')

@section('content')
            <hr>
    <div class="row  text-center">
        <div class="col-md-12">
            <ul class="list-group flex-row justify-content-center">
                @foreach($types as $type)
                    <li class="list-group-item">
                        <a class="nav-link" href="{{ route('projects.by_type', $type->name) }}">{{ $type->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
            <hr>


    <div class="jumbotron">
        <h1 class="display-4">Welcome to Crowdfunding</h1>
        <p class="lead">Support innovative projects and make a difference!</p>
    </div>
    <style>

    </style>

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

@endsection
