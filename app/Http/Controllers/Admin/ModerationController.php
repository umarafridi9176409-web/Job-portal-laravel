<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use App\Notifications\NewJobMatchAlert;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer', 'category'])->where('status', 'pending')->latest()->paginate(10);
        return view('admin.moderation.index', compact('jobs'));
    }

    public function approve(Job $job)
    {
        $job->update(['status' => 'approved']);

        // Notify matching seekers (simulated match by category)
        $matchingUsers = User::where('role', 'seeker')->get(); // In real app, filter by seeker preferences
        foreach ($matchingUsers as $user) {
            $user->notify(new NewJobMatchAlert($job));
        }

        return back()->with('success', 'Job approved successfully!');
    }

    public function reject(Job $job)
    {
        $job->update(['status' => 'rejected']);
        return back()->with('success', 'Job rejected successfully!');
    }
}
