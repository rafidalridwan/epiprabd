<?php

namespace App\Http\Controllers;

use App\Models\JobCircular;

class JobCircularController extends Controller
{
    public function index()
    {
        $jobCirculars = JobCircular::where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.jobs.index', compact('jobCirculars'));
    }

    public function show(string $slug)
    {
        $job = JobCircular::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.jobs.show', compact('job'));
    }
}
