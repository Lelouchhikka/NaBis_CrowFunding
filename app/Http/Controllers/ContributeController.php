<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Donation;
use Stripe\Stripe;
use Stripe\Charge;

class ContributeController extends Controller
{
    public function donate(Request $request)
    {
        // Validate donation data
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Get data from the form
        $projectId = $request->project_id;
        $amount = $request->amount;

        // Find the project and update the current_amount
        $project = Project::findOrFail($projectId);
        $project->current_amount += $amount;
        $project->save();

        // Create a new donation record
        $donation = new Contribution();
        $donation->user_id = auth()->user()->id;
        $donation->project_id = $projectId;
        $donation->amount = $amount;
        $donation->save();

        return redirect()->back()->with('success', 'Thank you for your donation!');
    }


}
