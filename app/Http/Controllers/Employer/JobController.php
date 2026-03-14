<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusChanged;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Auth::user()->jobs()->with('category')->latest()->paginate(10);
        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('employer.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Remote,Contract,Freelance',
        ]);

        $validated['employer_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);
        $validated['status'] = 'pending'; // Requires admin approval

        Job::create($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully! It will be visible after admin approval.');
    }

    public function edit(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('employer.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Remote,Contract,Freelance',
            'is_active' => 'required|boolean',
        ]);

        if ($job->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);
        }

        $job->update($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }
        $job->delete();
        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function applicants(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $applications = $job->applications()->with('seeker')->latest()->paginate(10);
        return view('employer.jobs.applicants', compact('job', 'applications'));
    }

    public function updateApplicationStatus(Request $request, Application $application)
    {
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,shortlisted,rejected,hired',
        ]);

        $application->update(['status' => $validated['status']]);

        // Notify Seeker
        $application->seeker->notify(new ApplicationStatusChanged($application));

        return back()->with('success', 'Application status updated and seeker notified!');
    }
}
