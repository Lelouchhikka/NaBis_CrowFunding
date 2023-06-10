<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $projects = Project::all();

        return view('pages.index', compact('types','projects'));
    }

    public function show(Project $project)
    {
        $updates = $project->updates;
        $rewards = $project->rewards;
        $totalContributions = $project->getTotalContributions();
        $percentageCompleted = $project->getPercentageCompleted();

        return view('projects.show', compact('updates','project', 'rewards','totalContributions', 'percentageCompleted'));
    }

    public function contribute(Project $project, Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1',
        ]);

        $contribution = new Contribution();
        $contribution->amount = $request->amount;
        $contribution->user_id = auth()->user()->id;

        $project->contributions()->save($contribution);

        // Обновляем текущую сумму проекта
        $project->current_amount += $request->amount;
        $project->save();

        return redirect()->route('projects.show', $project)->with('success', 'Thank you for your contribution!');
    }
    public function showByType($type)
    {
        // Find the type by its name
        $type = Type::where('name', $type)->firstOrFail();

        // Get the projects associated with the type
        $projects = $type->projects;

        return view('projects.by_type', compact('type', 'projects'));
    }
}
