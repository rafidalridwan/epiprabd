@extends('layouts.frontend')

@section('title', 'Project Map | ' . setting('site_name'))
@section('meta_description', 'Explore our portfolio projects on an interactive map.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<link rel="stylesheet" href="{{ asset('css/projects-map.css') }}">
@endpush

@section('content')
@include('partials.banner', [
    'bannerTitle' => 'Explore Our Projects on the Map',
    'bannerImage' => $page->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Project Map',
])

<div class="section-full p-t80 p-b80 projects-map-section">
    <div class="container">
        <div class="projects-map-header">
            <h2 class="text-uppercase font-36 m-b10">Project Locations</h2>
            <p class="projects-map-header__subtitle">Hover or click a marker to preview project details. Only projects with map coordinates are shown.</p>
            <div class="wt-separator-outer m-b30">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>

        @if($projects->isEmpty())
        <div class="projects-map-empty">
            <i class="fa fa-map-marker"></i>
            <h3>No mapped projects yet</h3>
            <p>Projects will appear here once latitude and longitude are added in the admin panel.</p>
            <a href="{{ route('projects.index') }}" class="site-button black radius-no text-uppercase m-t20">
                <span class="font-12 letter-spacing-5">View All Projects</span>
            </a>
        </div>
        @else
        <div class="projects-map-layout">
            <div id="projects-map" class="projects-map-canvas" aria-label="Interactive project locations map"></div>
            <aside class="projects-map-sidebar" aria-label="Project list">
                <div class="projects-map-sidebar__title">On the map</div>
                <ul class="projects-map-sidebar__list">
                    @foreach($projects as $project)
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
@if($projects->isNotEmpty())
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    window.projectsMapData = @json($mapProjects);
</script>
<script src="{{ asset('js/projects-map.js') }}"></script>
@endif
@endpush
