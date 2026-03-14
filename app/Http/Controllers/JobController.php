<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'location', 'type']);
        
        $jobs = Job::with(['category', 'employer'])
            ->active()
            ->filter($filters)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    public function show(Job $job)
    {
        if (!$job->is_active || $job->status !== 'approved') {
            abort(404);
        }

        $job->load(['category', 'employer']);
        
        return view('jobs.show', compact('job'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $jobs = Job::active()
            ->where('title', 'like', "%{$query}%")
            ->limit(5)
            ->get(['title', 'slug', 'location']);

        return response()->json($jobs);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $applications = $user->applications()->with(['job.employer', 'job.category'])->latest()->get();
        return view('seeker.dashboard', compact('applications'));
    }
}
