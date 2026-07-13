@extends('layouts.frontend')

@section('title', ($page->title ?? 'Projects') . ' | ' . setting('site_name'))

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<link rel="stylesheet" href="{{ asset('css/projects-map.css') }}">
@endpush

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

<div id="project-map" class="section-full p-t80 p-b80 projects-map-section">
    <div class="container">
        <div class="projects-map-header">
            <h2 class="text-uppercase font-36 m-b10">Project Map</h2>
            <p class="projects-map-header__subtitle">Hover or click a marker to preview project details. Only projects with map coordinates are shown.</p>
            <div class="wt-separator-outer m-b30">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>

        @if($mappedProjects->isEmpty())
        <div class="projects-map-empty">
            <i class="fa fa-map-marker"></i>
            <h3>No mapped projects yet</h3>
            <p>Projects will appear here once latitude and longitude are added in the admin panel.</p>
        </div>
        @else
        <div class="projects-map-layout">
            <div id="projects-map" class="projects-map-canvas" aria-label="Interactive project locations map"></div>
            <aside class="projects-map-sidebar" aria-label="Project list">
                <div class="projects-map-sidebar__title">On the map</div>
                <ul class="projects-map-sidebar__list">
                    @foreach($mappedProjects as $project)
                    <li>
                        <button
                            type="button"
                            class="projects-map-sidebar__item"
                            data-project-id="{{ $project->id }}"
                            data-lat="{{ $project->latitude }}"
                            data-lng="{{ $project->longitude }}"
                        >
                            <span class="projects-map-sidebar__marker"><i class="fa fa-map-marker"></i></span>
                            <span class="projects-map-sidebar__text">
                                <strong>{{ $project->title }}</strong>
                                @if($project->category)
                                <span>{{ $project->category->name }}</span>
                                @endif
                            </span>
                        </button>
                    </li>
                    @endforeach
                </ul>
            </aside>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if(!empty($activeCategoryId))
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
@endif
@if($mappedProjects->isNotEmpty())
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    window.projectsMapData = @json($mapProjects);
</script>
<script src="{{ asset('js/projects-map.js') }}"></script>
@endif
@endpush
