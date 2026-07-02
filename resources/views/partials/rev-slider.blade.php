@php
    $defaultSlides = [
        (object) ['image' => asset('images/main-slider/slider1/slide1.jpg'), 'title' => 'Virtually Build Your House', 'description' => 'Excepteur sint occaecat cupidatat non proident laborum.'],
        (object) ['image' => asset('images/main-slider/slider1/slide2.jpg'), 'title' => 'Natural plus modern.', 'description' => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        (object) ['image' => asset('images/main-slider/slider1/slide3.jpg'), 'title' => 'Creative & Professional', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'],
    ];
    $heroSlides = $sliders->isNotEmpty() ? $sliders : collect($defaultSlides);
@endphp

<div id="welcome_wrapper" class="rev_slider_wrapper fullscreen-container home-hero" data-alias="goodnews-header" data-source="gallery" style="background:transparent;padding:0;">
    <div class="home-hero-stage">
        <div id="welcome" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.3.1">
            <ul>
                @foreach($heroSlides as $index => $slide)
                    @include('partials.rev-slide', ['slide' => $slide, 'index' => $index + 1])
                @endforeach
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>

        <div class="home-hero-panel" id="home-hero-panel" aria-live="polite">
            <div class="home-hero-panel__progress" id="home-hero-progress"></div>
            <div class="home-hero-panel__content">
                <div class="home-hero-panel__text">
                    <p class="home-hero-panel__title"></p>
                    <p class="home-hero-panel__subtitle"></p>
                </div>
                <a class="home-hero-panel__link" href="#">View</a>
            </div>
        </div>
    </div>
</div>
