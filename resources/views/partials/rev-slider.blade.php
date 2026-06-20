@php
    $defaultSlides = [
        (object) ['image' => asset('images/main-slider/slider1/slide1.jpg'), 'subtitle' => 'GENERAL', 'title' => 'Virtually Build Your House', 'description' => 'Excepteur sint occaecat cupidatat non proident laborum.'],
        (object) ['image' => asset('images/main-slider/slider1/slide2.jpg'), 'subtitle' => 'GENERAL', 'title' => 'Natural plus modern.', 'description' => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
        (object) ['image' => asset('images/main-slider/slider1/slide3.jpg'), 'subtitle' => 'GENERAL', 'title' => 'Creative & Professional', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'],
    ];
    $heroSlides = $sliders->isNotEmpty() ? $sliders : collect($defaultSlides);
@endphp

<div id="welcome_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="goodnews-header" data-source="gallery" style="background:#eeeeee;padding:0px;">
    <div id="welcome" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.3.1">
        <ul>
            @foreach($heroSlides as $index => $slide)
                @include('partials.rev-slide', ['slide' => $slide, 'index' => $index + 1])
            @endforeach
        </ul>
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
    </div>
</div>
