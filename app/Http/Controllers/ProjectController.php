<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::with('category')
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.projects.index', compact('categories', 'projects'));
    }

    public function show(string $slug)
    {
        $project = Project::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.projects.show', compact('project'));
    }
}
