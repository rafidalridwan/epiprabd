@extends('layouts.frontend')

@section('body_attrs')
class="page-blogs"
@endsection

@section('title', ($page->title ?? 'Blogs') . ' | ' . setting('site_name'))
@section('meta_description', $page->meta_description ?? 'Latest articles and insights')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
@endpush

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? 'Insights, ideas, and inspiration',
    'bannerImage' => $page->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Blogs',
])

<div class="section-full p-t80 p-b50 bg-white blog-section">
    <div class="container">
        <div class="section-head text-left m-b40">
            <h2 class="text-uppercase font-36">{{ $page->heading ?? 'Our Blogs' }}</h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
            @if($page?->content)
            <div class="font-16 m-t15">{!! $page->content !!}</div>
            @else
            <p class="font-16 m-t15">Explore our latest articles, design insights, and project stories.</p>
            @endif
        </div>

        @if($blogs->count())
        <div class="blog-grid">
            @foreach($blogs as $blog)
            <article class="blog-card">
                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card__media">
                    <img src="{{ media_url($blog->image, 'images/gallery/portrait/pic1.jpg') }}" alt="{{ $blog->title }}">
                </a>
                <div class="blog-card__body">
                    <time class="blog-card__date" datetime="{{ ($blog->published_at ?? $blog->created_at)?->toDateString() }}">
                        {{ ($blog->published_at ?? $blog->created_at)?->format('F d, Y') }}
                    </time>
                    <h3 class="blog-card__title">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                    </h3>
                    @if($blog->excerpt)
                    <p class="blog-card__excerpt">{{ Str::limit(strip_tags($blog->excerpt), 140) }}</p>
                    @endif
                    <a href="{{ route('blog.show', $blog->slug) }}" class="site-button black radius-no text-uppercase blog-card__cta">
                        <span class="font-12 letter-spacing-5">Read More</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center p-t40 p-b40">
            <p class="font-16">No blog posts yet. Please check back later.</p>
        </div>
        @endif
    </div>
</div>
@endsection
