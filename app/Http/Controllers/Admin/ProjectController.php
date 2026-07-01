<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('category')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project,
            'categories' => ProjectCategory::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = store_public_upload($request->file('image'), 'uploads/projects');
        }
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = store_public_upload($request->file('banner_image'), 'uploads/projects');
        }

        $project = Project::create($validated);
        $this->storeGalleryImages($project, $request);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', [
            'project' => $project->load('images'),
            'categories' => ProjectCategory::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = store_public_upload($request->file('image'), 'uploads/projects');
        } else {
            unset($validated['image']);
        }
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = store_public_upload($request->file('banner_image'), 'uploads/projects');
        } else {
            unset($validated['banner_image']);
        }

        $project->update($validated);
        $this->removeGalleryImages($project, $request);
        $this->updateGalleryVideoUrls($project, $request);
        $this->storeGalleryImages($project, $request);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'project_category_id' => 'nullable|exists:project_categories,id',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'project_date' => 'nullable|date',
            'client' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',
            'creative_director' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
            'banner_image' => 'nullable|image|max:4096',
            'images' => 'nullable|array',
            'images.*' => 'image|max:4096',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer|exists:project_images,id',
            'video_urls' => 'nullable|array',
            'video_urls.*' => 'nullable|string|max:500',
            'new_video_urls' => 'nullable|array',
            'new_video_urls.*' => 'nullable|string|max:500',
        ]);
    }

    private function normalizeYoutubeUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        return youtube_video_id($url) ? $url : null;
    }

    private function updateGalleryVideoUrls(Project $project, Request $request): void
    {
        foreach ($request->input('video_urls', []) as $imageId => $url) {
            $project->images()->whereKey($imageId)->update([
                'youtube_url' => $this->normalizeYoutubeUrl($url),
            ]);
        }
    }

    private function storeGalleryImages(Project $project, Request $request): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $sortOrder = (int) $project->images()->max('sort_order');
        $newVideoUrls = $request->input('new_video_urls', []);

        foreach ($request->file('images') as $index => $file) {
            $project->images()->create([
                'image' => store_public_upload($file, 'uploads/projects'),
                'youtube_url' => $this->normalizeYoutubeUrl($newVideoUrls[$index] ?? null),
                'sort_order' => ++$sortOrder,
            ]);
        }
    }

    private function removeGalleryImages(Project $project, Request $request): void
    {
        $removeIds = $request->input('remove_images', []);

        if (empty($removeIds)) {
            return;
        }

        $project->images()->whereIn('id', $removeIds)->delete();
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}
