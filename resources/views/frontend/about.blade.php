@extends('layouts.frontend')

@section('title', $page->meta_title ?? 'About Us')
@section('meta_description', $page->meta_description)

@section('content')
@include('partials.banner', [
    'bannerTitle' => $page->banner_title ?? $page->title,
    'bannerImage' => $page->banner_image,
    'breadcrumb' => $page->title ?? 'About Us',
])

@php
    $galleryImages = collect($page->about_gallery_images ?? [])->filter();
    if ($galleryImages->isEmpty()) {
        $galleryImages = collect(range(2, 6))->map(fn ($i) => "images/gallery/portrait/pic{$i}.jpg");
    }
@endphp

<div class="section-full p-t80 p-b50 bg-gray square_shape2">
    <div class="container">
        <div class="section-content">
            <div class="row d-flex align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 m-b50">
                    <div class="owl-carousel about-us-carousel owl-btn-bottom-right">
                        @foreach($galleryImages as $image)
                        <div class="item">
                            <div class="ow-img wt-img-effect zoom-slow">
                                <img src="{{ media_url($image, 'images/gallery/portrait/pic2.jpg') }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 m-b30">
                    <div class="m-about-containt text-uppercase text-black p-t30">
                        @if($page->subtitle)<span class="font-30 font-weight-300">{{ $page->subtitle }}</span>@endif
                        @if($page->heading)<h2 class="font-40">{{ $page->heading }}</h2>@endif
                        @if($page->content)<div>{!! $page->content !!}</div>@endif
                        @if($page->about_button_text)
                        <a href="{{ $page->about_button_link ?: route('contact') }}" class="site-button black radius-no text-uppercase">
                            <span class="font-12 letter-spacing-5">{{ $page->about_button_text }}</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(($page->show_experts_section ?? true) && $teamMembers->isNotEmpty())
<div class="section-full bg-white square_shape2 about-experts-section p-t80 p-b50">
    <div class="container">
        <div class="section-head text-center text-black m-b50 about-experts-heading" data-expert-animate>
            <h2 class="text-uppercase font-36">{{ $page->experts_heading ?? 'Our experts' }}</h2>
            <div class="wt-separator-outer"><div class="wt-separator bg-black"></div></div>
        </div>
        <div class="row justify-content-center">
            @foreach($teamMembers as $member)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 m-b30" data-expert-animate data-delay="{{ $loop->index * 100 }}">
                <div class="about-expert-card bg-white">
                    <div class="about-expert-card__media">
                        <img src="{{ media_url($member->image) }}" alt="{{ $member->name }}">
                    </div>
                    <div class="about-expert-card__info text-center p-lr10 p-tb20">
                        <h5 class="wt-team-title text-uppercase m-a0">{{ $member->name }}</h5>
                        <p class="m-b0">{{ $member->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about-experts.css') }}">
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    $('.about-us-carousel').owlCarousel({ items: 1, loop: true, nav: true });

    var expertsSection = document.querySelector('.about-experts-section');
    if (!expertsSection) return;

    var animatedItems = expertsSection.querySelectorAll('[data-expert-animate]');
    if (!animatedItems.length) return;

    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        animatedItems.forEach(function (el) { el.classList.add('is-visible'); });
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;

            var delay = parseInt(entry.target.getAttribute('data-delay') || '0', 10);
            setTimeout(function () {
                entry.target.classList.add('is-visible');
            }, delay);

            observer.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -30px 0px' });

    animatedItems.forEach(function (el) { observer.observe(el); });
});
</script>
@endpush
