<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobCircular;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $job = JobCircular::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        if (! $job->isOpen()) {
            return back()->with('error', 'Applications for this position are closed.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string|max:5000',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $cv = $request->file('cv');
        $cvPath = $cv->store('cvs', 'local');

        JobApplication::create([
            'job_circular_id' => $job->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'] ?? null,
            'cv_path' => $cvPath,
            'cv_original_name' => $cv->getClientOriginalName(),
        ]);

        return redirect()
            ->route('jobs.show', $job->slug)
            ->with('success', 'Thank you! Your application has been submitted successfully.');
    }
}
