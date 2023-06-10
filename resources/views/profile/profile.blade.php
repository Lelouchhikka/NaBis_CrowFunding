@extends('layouts.app')

@section('title', 'Crowdfunding')

@section('content')
    <div class="container">
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-4">Ваши проекты</h1>
            <a href="{{ route('add_project') }}" class="btn btn-primary">Add Project</a>
        </div>
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
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-secondary">Edit Project</a>

                        <hr>

                        <h6>Rewards:</h6>
                        <ul>
                            @foreach($project->rewards as $reward)
                                <li>
                                    {{ $reward->title }} - Min. Contribution: ${{ $reward->min_contribution }}
                                    <a href="{{ route('rewards.edit', ['reward' => $reward->id,'project'=>$project]) }}" class="btn btn-sm btn-secondary">Edit Reward</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('rewards.create', ['project' => $project]) }}" class="btn btn-sm btn-success">Add Reward</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
