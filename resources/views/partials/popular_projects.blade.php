@foreach ($popularProjects as $project)
    <div class="project-card shadow-sm">
        <a href="{{ route('projects.show', $project)}}" class="project-image">
            <img src="{{ asset('storage/' . $project->photo) }}" class="card-img-top project-image" alt="Изображение проекта">
        </a>
        <div class="project-details">
            <h3 class="project-title">{{ $project->title }}</h3>
            <p class="project-description">{{ $project->description }}</p>
            <div class="project-progress">
                <div class="progress bg-success" style="width: {{  ($project->current_amount / $project->goal) * 100  }}%"></div>
            </div>
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

{{ $popularProjects->links() }}
