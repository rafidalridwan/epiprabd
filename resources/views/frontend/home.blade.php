@extends('layouts.frontend')

@section('title', $page->meta_title ?? setting('site_name'))
@section('meta_description', $page->meta_description)

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/revolution/revolution/css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/revolution/revolution/css/navigation.css') }}">
<link rel="stylesheet" href="{{ asset('css/rev-slider-4.css') }}">
<link rel="stylesheet" href="{{ asset('css/home-slider-responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/rev-glass-break.css') }}">
<link rel="stylesheet" href="{{ asset('css/clients-section.css') }}">
@endpush

@section('content')

@include('partials.rev-slider')


<div class="section-full clearfix p-t80 bg-gray">
    <div class="container">
        <div class="section-content">
            <div class="row d-flex align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 m-b50">
                    <div class="ow-img wt-img-effect zoom-slow">
                        <img src="{{ media_url($page->intro_image, 'images/gallery/portrait/pic2.jpg') }}" alt="{{ $page->heading }}">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 m-b30">
                    <div class="m-about-containt text-uppercase text-black p-t30">
                        <span class="font-30 font-weight-300">{{ $page->subtitle ?? 'Welcome' }}</span>
                        <h2 class="font-40">{{ $page->heading ?? 'We are creative Architecture Studio' }}</h2>
                        <div class="text-lowercase">{!! $page->content ?? '' !!}</div>
                        <a href="{{ route('about') }}" class="site-button black radius-no text-uppercase"><span class="font-12 letter-spacing-5">Read More</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-full p-t80 p-lr80 latest_project-outer square_shape3">
    <div class="container">
        <div class="section-head text-left">
            <h2 class="text-uppercase font-36">Latest Projects</h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>
    </div>
    <div class="section-content">
        <div class="owl-carousel latest_project-carousel owl-btn-vertical-center">
            @foreach($featuredProjects as $project)
            <div class="item">
                <div class="wt-img-effect zoom-slow">
                    <a href="{{ route('projects.show', $project->slug) }}">
                        <img src="{{ media_url($project->image) }}" alt="{{ $project->title }}">
                    </a>
                </div>
                <div class="wt-info p-t20">
                    <h4 class="m-a0"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a></h4>
                    <p>{{ strip_tags($project->excerpt) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- WHO WE ARE SECTION START -->
<div class="section-full p-t140 clearfix bg-repeat tm-wo-we-r" style="background-image:url({{ asset('images/background/ptn-1.png') }});">
    <div class="container-fluid">
        <div class="section-content">
            <div class="row d-flex align-items-center">
                <div class="col-xl-6 col-lg-5 col-md-12">
                    <div class="wt-left-part">
                        <div class="text-uppercase text-black">
                            @if($page->who_subtitle)<span class="font-30 font-weight-300 d-block m-b10">{{ $page->who_subtitle }}</span>@endif
                            @if($page->who_heading)<h2 class="font-40">{{ $page->who_heading }}</h2>@endif
                            @if($page->who_content)<p>{{ $page->who_content }}</p>@endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-12">
                    <div class="m-carousel-2">
                        <div class="owl-carousel carousel-hover home-carousel-2 owl-btn-vertical-center">
                            @foreach($carouselProjects as $project)
                            <div class="item">
                                <div class="wt-box">
                                    <div class="ow-img wt-carousel-block gradi-black">
                                        <img src="{{ media_url($project->image) }}" alt="{{ $project->title }}">
                                        <div class="p-a50 wt-carousel-info text-white">
                                            <div class="carousel-line">
                                                <h2 class="font-28 font-weight-400 m-b10">{{ $project->title }}</h2>
                                                <p class="m-b0">{{ strip_tags($project->excerpt) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="carousel-bg-img">
                            <img src="{{ asset('images/slider-corner.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($page->who_badge_strong || $page->who_badge_span)
    <div class="container">
        <div class="hilite-title p-lr20 m-tb20 text-left text-uppercase bdr-gray bdr-left">
            @if($page->who_badge_strong)<strong>{{ $page->who_badge_strong }}</strong>@endif
            @if($page->who_badge_span)<span class="text-black">{{ $page->who_badge_span }}</span>@endif
        </div>
    </div>
    @endif
</div>
<!-- WHO WE ARE SECTION END -->





<!-- COMPANY DETAIL SECTION START -->
<div class="section-full p-t80 p-b50 overlay-wraper bg-top-center bg-parallax" data-stellar-background-ratio="0.5" style="background-image:url({{ asset($page->facts_bg_image ?? 'images/background/bg-11.jpg') }});">
    <div class="overlay-main opacity-08 bg-black"></div>
    <div class="container ">
        <div class="row">

            <div class="col-lg-6 col-md-12 m-b30">
                <div class="some-facts">
                    <div class="text-white text-uppercase">
                        @if($page->facts_subtitle)<span class="font-40 font-weight-300">{{ $page->facts_subtitle }}</span>@endif
                        @if($page->facts_heading)<h2 class="font-50">{{ $page->facts_heading }}</h2>@endif
                        @if($page->facts_content)<p class="font-18 font-weight-300">{{ $page->facts_content }}</p>@endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="row some-facts-counter">
                    @foreach($page->facts_stats ?? [] as $stat)
                    <div class="col-md-4 col-sm-4">
                        <div class="wt-icon-box-wraper p-a10 text-white m-b30">
                            <div class="icon-content text-center">
                                <div class="font-40 font-weight-600 m-b5"><span class="counter">{{ $stat['value'] ?? 0 }}</span></div>
                                <div class="wt-separator-outer m-b20">
                                    <div class="wt-separator bg-white"></div>
                                </div>
                                <span class="text-uppercase">{{ $stat['label'] ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<!-- COMPANY DETAIL SECTION End -->

<!-- TESTIMONIALS SECTION START -->
@if($testimonials->count())
<div class="section-full p-t80 clearfixbg-repeat " style="background-image:url({{ asset('images/background/ptn-1.png') }});">
    <div class="container">
        <div class="section-content">
            <div class="section-head text-left">
                <h2 class="text-uppercase font-36">Testimonials</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator bg-black"></div>
                </div>
            </div>
            <div class="section-content">
                <div class="owl-carousel testimonial-home">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="testimonial-6">
                            <div class="testimonial-pic-block">
                                <div class="testimonial-pic">
                                    <img src="{{ media_url($testimonial->image) }}" width="132" height="132" alt="{{ $testimonial->name }}">
                                </div>
                            </div>
                            <div class="testimonial-text clearfix bg-white">
                                <div class="testimonial-detail clearfix">
                                    <strong class="testimonial-name">{{ $testimonial->name }}</strong>
                                    @if($testimonial->position)<span class="testimonial-position p-t0">{{ $testimonial->position }}</span>@endif
                                </div>
                                <div class="testimonial-paragraph text-black p-t15">
                                    <span class="fa fa-quote-left"></span>
                                    <p>{{ $testimonial->quote }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="hilite-title p-lr20 m-tb20 text-right text-uppercase bdr-gray bdr-right">
            <strong>Client</strong>
            <span class="text-black">Says</span>
        </div>
    </div>
</div>
@endif
<!-- TESTIMONIALS SECTION END -->
<!-- CLIENT LOGO SECTION START -->
@if($clients->count())
<section class="clients-section">
    <div class="clients-section__bg" aria-hidden="true"></div>
    <div class="container">
        <div class="clients-section__header">
            <span class="clients-section__label">Trusted Partners</span>
            <h2 class="clients-section__title">Our Clients</h2>
            <p class="clients-section__subtitle">Brands and organizations we've partnered with to deliver exceptional results.</p>
        </div>

        <div class="clients-section__carousel">
            <div class="owl-carousel home-client-carousel owl-btn-vertical-center">
                @foreach($clients as $client)
                <div class="item">
                    <div class="clients-section__card">
                        @if($client->url)
                        <a href="{{ $client->url }}" target="_blank" rel="noopener noreferrer" title="{{ $client->name ?? 'Client' }}">
                            <img src="{{ media_url($client->logo) }}" alt="{{ $client->name ?? 'Client' }}">
                        </a>
                        @else
                        <img src="{{ media_url($client->logo) }}" alt="{{ $client->name ?? 'Client' }}">
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- CLIENT LOGO SECTION End -->
@endsection

@push('scripts')
<script src="{{ asset('plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/revolution/js/extensions/revolution-plugin.js') }}"></script>
<script src="{{ asset('js/rev-script-1.js') }}"></script>
<script src="{{ asset('js/rev-glass-break.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.latest_project-carousel').owlCarousel({
            items: 3,
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    });
</script>
@endpush