@extends('layouts.frontend')

@section('title', ($page->title ?? 'Projects') . ' | ' . setting('site_name'))

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? 'Creating places that enhance the human experience.',
    'bannerImage' => $page->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Projects',
])

<div class="section-full p-t80 p-b50">
    <div class="container">
        <div class="filter-wrap p-b50">
            <ul class="masonry-filter link-style text-uppercase">
                <li class="{{ empty($activeCategoryId) ? 'active' : '' }}"><a data-filter="*" href="{{ route('projects.index') }}">All</a></li>
                @foreach($categories as $category)
                <li class="{{ (int) $activeCategoryId === (int) $category->id ? 'active' : '' }}">
                    <a data-filter=".cat-{{ $category->id }}" href="{{ route('projects.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="portfolio-wrap mfp-gallery work-grid clearfix">
        <div class="container-fluid">
            <div class="row">
                @foreach($projects as $project)
                <div class="masonry-item cat-{{ $project->project_category_id }} col-xl-3 col-lg-4 col-md-6 col-sm-6 m-b30">
                    <div class="wt-img-effect">
                        <img src="{{ media_url($project->image) }}" alt="{{ $project->title }}">
                        <div class="overlay-bx-2">
                            <div class="line-amiation">
                                <div class="text-white font-weight-300 p-a40">
                                    <h2><a href="{{ route('projects.show', $project->slug) }}" class="text-white font-20 letter-spacing-4 text-uppercase">{{ $project->title }}</a></h2>
                                    <p>{{ strip_tags($project->excerpt) }}</p>
                                    <a href="{{ route('projects.show', $project->slug) }}" class="v-button letter-spacing-4 font-12 text-uppercase p-l20">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@if(!empty($activeCategoryId))
@push('scripts')
<script>
    jQuery(function ($) {
        var selector = '.cat-{{ $activeCategoryId }}';
        var $container = $('.portfolio-wrap');
        var attempts = 0;

        function applyCategoryFilter() {
            if ($container.length && $.fn.isotope && $container.data('isotope')) {
                $container.isotope({ filter: selector });
                return;
            }

            attempts += 1;
            if (attempts < 30) {
                window.setTimeout(applyCategoryFilter, 100);
            }
        }

        applyCategoryFilter();
    });
</script>
@endpush
@endif
