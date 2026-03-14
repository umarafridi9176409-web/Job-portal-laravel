<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function index()
    {
        $savedJobs = Auth::user()->savedJobs()->with(['employer', 'category'])->latest()->paginate(10);
        return view('jobs.saved', compact('savedJobs'));
    }

    public function toggle(Job $job)
    {
        $user = Auth::user();
        if ($user->savedJobs()->where('job_id', $job->id)->exists()) {
            $user->savedJobs()->detach($job->id);
            $message = 'Job removed from saved list.';
        } else {
            $user->savedJobs()->attach($job->id);
            $message = 'Job saved successfully!';
        }

        return back()->with('success', $message);
    }
}
