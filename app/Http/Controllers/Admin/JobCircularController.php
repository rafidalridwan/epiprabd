<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCircularController extends Controller
{
    public function index()
    {
        return view('admin.jobs.index', [
            'jobs' => JobCircular::orderBy('sort_order')->orderByDesc('created_at')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.jobs.form', ['job' => new JobCircular]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateJob($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['show_on_home'] = $request->boolean('show_on_home');

        JobCircular::create($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job circular created successfully.');
    }

    public function edit(JobCircular $job)
    {
        return view('admin.jobs.form', compact('job'));
    }

    public function update(Request $request, JobCircular $job)
    {
        $validated = $this->validateJob($request);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['show_on_home'] = $request->boolean('show_on_home');

        if ($job->title !== $validated['title']) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $job->id);
        }

        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job circular updated successfully.');
    }

    public function destroy(JobCircular $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job circular deleted successfully.');
    }

    private function validateJob(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'department' => 'nullable|string|max:255',
            'job_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'vacancies' => 'nullable|integer|min:1',
            'deadline' => 'nullable|date',
            'sort_order' => 'nullable|integer',
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            JobCircular::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}
