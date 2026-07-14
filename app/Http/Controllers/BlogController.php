<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;

class BlogController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'blog')->where('is_published', true)->first();
        $blogs = Blog::where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.blogs.index', compact('page', 'blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $related = Blog::where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('frontend.blogs.show', compact('blog', 'related'));
    }
}
