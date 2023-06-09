<!-- contribute.blade.php -->
@extends('layouts.app')

@section('title', 'Contribute to Project')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Contribute to Project</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.contribute', $project) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" class="form-control" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Contribute</button>
            </form>
        </div>
    </div>
@endsection
