@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $project->title }}</h3>
        </div>
        <div class="card-body">
            <img src="{{ asset('storage/' . $project->photo) }}" alt="Project Photo" class="mb-3">
            <p>{{ $project->description }}</p>
            <p>Goal: ${{ $project->goal }}</p>
            <p>Current Amount: ${{ $project->current_amount }}</p>
            <div class="progress mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentageCompleted }}%" aria-valuenow="{{ $percentageCompleted }}" aria-valuemin="0" aria-valuemax="100">{{ $percentageCompleted }}%</div>
            </div>
            <p>Total Contributions: ${{ $totalContributions }}</p>
        </div>
    </div>

    <h4 class="mt-4">Make a Contribution</h4>
    @auth
        <!-- Форма пожертвования -->
        <form action="{{ route('donate') }}" method="POST">
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
@endsection
