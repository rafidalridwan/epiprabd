<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::orderBy('sort_order')->orderByDesc('published_at')->orderByDesc('created_at')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.blogs.form', ['blog' => new Blog]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateBlog($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = ! empty($validated['published_at'])
            ? $validated['published_at']
            : now();

        if ($request->hasFile('image')) {
            $validated['image'] = store_public_upload($request->file('image'), 'uploads/blog');
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $this->validateBlog($request);
        $validated['is_published'] = $request->boolean('is_published');

        if (empty($validated['published_at'])) {
            $validated['published_at'] = $blog->published_at ?? now();
        }

        if ($blog->title !== $validated['title']) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $blog->id);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = store_public_upload($request->file('image'), 'uploads/blog');
        } else {
            unset($validated['image']);
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    private function validateBlog(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:4096',
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            Blog::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }
}
