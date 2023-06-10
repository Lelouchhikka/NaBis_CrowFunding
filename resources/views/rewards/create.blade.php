@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Reward</h1>
        <form action="{{ route('rewards.store', ['project' => $project]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="min_contribution">Minimum Contribution</label>
                <input type="number" name="min_contribution" id="min_contribution" class="form-control">
            </div>
            <div class="form-group">
                <label for="max_backers">Maximum Backers</label>
                <input type="number" name="max_backers" id="max_backers" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Reward</button>
        </form>
    </div>
@endsection
