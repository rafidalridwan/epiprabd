<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $page = Page::where('slug', 'projects')->where('is_published', true)->first();
        $activeCategory = request('category');
        $activeCategoryId = $categories->firstWhere('slug', $activeCategory)?->id;

        $mappedProjects = $projects
            ->filter(fn (Project $project) => $project->latitude !== null && $project->longitude !== null)
            ->values();

        $mapProjects = $mappedProjects->map(fn (Project $project) => [
            'id' => $project->id,
            'title' => $project->title,
            'slug' => $project->slug,
            'excerpt' => strip_tags($project->excerpt ?? ''),
            'category' => $project->category?->name,
            'client' => $project->client,
            'project_type' => $project->project_type,
            'image' => media_url($project->image),
            'url' => route('projects.show', $project->slug),
            'lat' => (float) $project->latitude,
            'lng' => (float) $project->longitude,
        ])->values();

        return view('frontend.projects.index', compact(
            'categories',
            'projects',
            'page',
            'activeCategory',
            'activeCategoryId',
            'mappedProjects',
            'mapProjects'
        ));
    }

    public function show(string $slug)
    {
        $project = Project::with('category', 'images')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.projects.show', compact('project'));
    }
}
