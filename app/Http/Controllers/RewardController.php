<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    private function check($reward){
        // Проверяем, принадлежит ли вознаграждение текущему аутентифицированному пользователю
        if ($reward->project->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'У вас нет прав на выполнение данной операции');
        }

    }
    public function index()
    {
        $rewards = Reward::all();

        return view('rewards.index', compact('rewards'));
    }

    public function create($project)
    {
        return view('rewards.create',compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request['project_id'] = $project->id;
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required',
            'description' => 'nullable',
            'min_contribution' => 'required|numeric',
            'max_backers' => 'nullable|integer',
        ]);

        Reward::create($validatedData);

        return redirect()->route('profile');
    }


    public function show(Reward $reward)
    {
        return view('rewards.show', compact('reward'));
    }

    public function edit( $reward, $project)
    {
        $reward = Reward::findOrFail($reward);
        return view('rewards.edit', compact('reward','project'));
    }

    public function update(Request $request,  $reward)
    {
        $validatedData = $request->validate([
            'project_id' => 'nullable',
            'title' => 'required',
            'description' => 'nullable',
            'min_contribution' => 'required|numeric',
            'max_backers' => 'nullable|integer',
        ]);
        $reward = Reward::findOrFail($reward);
        $reward->update($validatedData);

        return redirect()->route('profile');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();

        return redirect()->route('rewards.index');
    }
}

