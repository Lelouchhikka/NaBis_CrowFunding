<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        // Возвращает список всех проектов
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }
    public function create()
    {
        $types = Type::all();

        return view('profile.add_project', compact('types'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goal' => 'required|numeric',
            'deadline' => 'required|date',
            'type' => 'required',
            'photo' => 'required|image|max:2048',
            'video' => 'mimes:mp4|max:20480',
        ]);

        // Обработка загрузки фотографии
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Обработка загрузки видео
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $validatedData['video'] = $videoPath;
        }

        $validatedData['user_id']=Auth::id();
        $project = Project::create($validatedData);

        return redirect()->route('projects.show', $project);
    }
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('projects.edit', compact('project', 'types'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'goal' => 'required|numeric',
            'photo' => 'nullable|image',
            'video' => 'nullable|url',
            'type_id' => 'required|exists:types,id',
        ]);
        if ($request['deadline']!=null) {
            $validatedData['deadline'] = $request->deadline;
        } else {
            // Set a default value for deadline
            $validatedData['deadline'] = $project->deadline;
        }
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $validatedData['photo'] = $photoPath;
        }

        $project->update($validatedData);

        return redirect()->route('projects.show', $project);
    }
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('user.profile');
    }

    public function userProjects(){
        $user = auth()->user();
        $projects = $user->projects;
        return view('profile.profile',compact('projects'));
    }

    public function show($id)
    {
        // Возвращает информацию о конкретном проекте по его идентификатору
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }
}
