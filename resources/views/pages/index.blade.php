@extends('layouts.app')

@section('title', 'Crowdfunding')

@section('content')
    <div class="jumbotron text-center mb-3  align-items-center">
        <h1 class="display-4">Добро пожаловать Набис</h1>
        <p class="lead">Найди свой любимый проект или создай свой</p>
        <hr class="my-4">
        <p>Открой для себя мир инновационых проектов</p>
        @auth
        @else
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Начать поиск</a>
    </div>
    @endif

    <div class="d-flex flex-wrap justify-content-between">
        <div class="featured-projects w-50">
            <h2 class="section-title">Любимый проект</h2>
            <div class="project-list">
                @foreach ($featuredProjects as $project)
                    <div class="project-card shadow">
                        <a href="{{ route('projects.show', $project)}}" class="project-image">
                            <img src="{{ asset('storage/' . $project->photo) }}" class="card-img-top img-thumbnail" alt="Изображение проекта">
                        </a>
                        <div class="project-details">
                            <div class="project-progress">
                                <div class="progress bg-success" style="width: {{  ($project->current_amount / $project->goal) * 100  }}%"></div>
                            </div>
                            <h2 class="project-title m-2 fs-2">{{ $project->title }}</h2>
                            <p class="project-description">{{ $project->description }}</p>
                            <div class="project-stats">
                                <div class="stat-item">
                                    <span class="stat-label">Цель:</span>
                                    <span class="stat-value">{{ $project->goal }}$</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Собрано:</span>
                                    <span class="stat-value">{{ $project->current_amount }}$</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Осталось дней:</span>
                                    <span class="stat-value">{{ $project->created_at->diffInDays(now()) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="popular-projects w-50">
            <h2 class="section-title">Популярные проекты</h2>
            <div id="popular-projects-container" class="project-list align-items-center">
                @include('partials.popular_projects')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function loadPopularProjects(page) {
                $.ajax({
                    url: "{{ route('popular-projects') }}",
                    data: { page: page },
                    dataType: 'html',
                    success: function(response) {
                        $('#popular-projects-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            loadPopularProjects(1);

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadPopularProjects(page);
            });
        });
    </script>

@endsection
