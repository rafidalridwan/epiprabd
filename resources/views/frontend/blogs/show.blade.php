@extends('layouts.frontend')

@section('body_attrs')
class="page-blog-detail"
@endsection

@section('title', $blog->title . ' | ' . setting('site_name'))
@section('meta_description', Str::limit(strip_tags($blog->excerpt ?: $blog->content), 160))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
@endpush

@section('content')
@php $sliderItems = $blog->sliderItems(); @endphp
@include('partials.banner', [
    'bannerTitle' => $blog->title,
    'bannerImage' => $blog->image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Blog',
])

<div class="section-full p-t80 p-b50 blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 m-b30">
                <article class="blog-detail bg-white">
                    @if($sliderItems->isNotEmpty())
                    <div class="blog-detail__media">
                        <div class="owl-carousel blog-detail-carousel owl-btn-bottom-right">
                            @foreach($sliderItems as $slide)
                            <div class="item">
                                <div class="blog-detail__slide">
                                    <img src="{{ media_url($slide->image, 'images/gallery/portrait/pic1.jpg') }}" alt="{{ $blog->title }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="blog-detail__body">
                        <time class="blog-detail__date" datetime="{{ ($blog->published_at ?? $blog->created_at)?->toDateString() }}">
                            {{ ($blog->published_at ?? $blog->created_at)?->format('F d, Y') }}
                        </time>
                        <h1 class="blog-detail__title text-uppercase">{{ $blog->title }}</h1>
                        @if($blog->excerpt)
                        <p class="blog-detail__excerpt">{{ strip_tags($blog->excerpt) }}</p>
                        @endif
                        <div class="blog-detail__content">
                            {!! $blog->content !!}
                        </div>
                        <a href="{{ route('blog.index') }}" class="site-button black radius-no text-uppercase m-t30">
                            <span class="font-12 letter-spacing-5">Back to Blogs</span>
                        </a>
                    </div>
                </article>
            </div>

            <div class="col-lg-4 col-md-12">
                @if($related->count())
                <aside class="blog-related">
                    <h4 class="text-uppercase m-t0 m-b30">Related Posts</h4>
                    @foreach($related as $item)
                    <a href="{{ route('blog.show', $item->slug) }}" class="blog-related__item">
                        <div class="blog-related__thumb">
                            <img src="{{ media_url($item->image, 'images/gallery/portrait/pic1.jpg') }}" alt="{{ $item->title }}">
                        </div>
                        <div>
                            <strong>{{ $item->title }}</strong>
                            <span>{{ ($item->published_at ?? $item->created_at)?->format('M d, Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </aside>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    var $carousel = $('.blog-detail-carousel');

    if (!$carousel.length) {
        return;
    }

    $carousel.owlCarousel({
        items: 1,
        loop: $carousel.find('.item').length > 1,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        margin: 0,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        smartSpeed: 600,
    });
});
</script>
@endpush
