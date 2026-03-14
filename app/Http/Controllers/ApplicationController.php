<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        if (Auth::user()->isEmployer()) {
            return back()->with('error', 'Employers cannot apply for jobs.');
        }

        if (Application::where('job_id', $job->id)->where('seeker_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_id' => $job->id,
            'seeker_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'status' => Application::STATUS_PENDING,
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }
}
