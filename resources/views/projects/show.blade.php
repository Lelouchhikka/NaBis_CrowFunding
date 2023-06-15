@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="project-details">
        <div class="project-header">
            <h3>{{ $project->title }}</h3>
        </div>
        <div class="project-body">
            <div class="project-image">
                <img src="{{ asset('storage/' . $project->photo) }}" alt="Project Photo" class="project-photo">
            </div>
            <div class="project-info">
                <p class="project-description">{{ $project->description }}</p>
                <p class="project-goal">Goal: ${{ $project->goal }}</p>
                <p class="project-current-amount">Current Amount: ${{ $project->current_amount }}</p>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentageCompleted }}%" aria-valuenow="{{ $percentageCompleted }}" aria-valuemin="0" aria-valuemax="100">{{ $percentageCompleted }}%</div>
                </div>
                <p class="project-contributions">Total Contributions: ${{ $totalContributions }}</p>
            </div>

        </div>
    </div>
    <h4 class="mt-4">Rewards</h4>
    <ul class="list-group mb-3">
        @foreach ($rewards as $reward)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $reward->title }}
                <span class="badge badge-primary text-black">$ {{ $reward->min_contribution }}</span>
            </li>
        @endforeach
    </ul>
    <h4 class="mt-4">Updates</h4>
    <ul class="list-group mb-3">
        @foreach ($updates as $update)
            <li class="list-group-item">
                <h5>{{ $update->title }}</h5>
                <p>{{ $update->body }}</p>
                <p class="text-muted">{{ $update->created_at->diffForHumans() }}</p>
            </li>
        @endforeach
    </ul>

    <h4 class="mt-4">Make a Contribution</h4>
    @auth
        <!-- Форма пожертвования -->
        <form action="{{ route('donate') }}" method="POST" class="contribution-form">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0.01" required>
            </div>
            <div class="form-group">
                <label for="card-element">Card Details:</label>
                <div id="card-element" class="form-control">
                    <!-- Element for Stripe.js -->
                </div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button type="submit" class="btn btn-primary">Donate</button>
        </form>

        <!-- Подключение Stripe.js -->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- Инициализация Stripe.js -->
        <script>
            var stripe = Stripe('{{ config('services.stripe.key') }}');
            var elements = stripe.elements();

            var card = elements.create('card');
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        </script>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to contribute to this project.</p>
    @endauth

    <style>
        /* Добавьте стили Kickstarter здесь */

        .project-details {
            margin-top: 30px;
        }

        .project-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .project-header h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .project-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #b799e5;
        }

        .project-image {
            flex: 1;
            margin-right: 30px;
        }

        .project-photo {
            width: 100%;
        }

        .project-info {
            flex: 2;
        }

        .project-description {
            margin-bottom: 10px;
        }

        .progress {
            height: 20px;
            margin-bottom: 10px;
        }

        .project-contributions {
            margin-top: 20px;
        }

        .contribution-form {
            margin-top: 30px;
        }
    </style>
@endsection
