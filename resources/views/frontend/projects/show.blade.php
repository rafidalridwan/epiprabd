@extends('layouts.frontend')

@section('title', $project->title . ' | ' . setting('site_name'))

@section('content')
@include('partials.banner', [
    'bannerTitle' => 'Creating places that enhance the human experience.',
    'bannerImage' => $project->banner_image ?? 'images/background/bg-11.jpg',
    'breadcrumb' => 'Project detail',
])

<div class="section-full p-t80 p-b50">
    <div class="container">
        <div class="project-detail-outer bg-parallax m-b30" data-stellar-background-ratio="0.5" style="background-image:url({{ media_url($project->banner_image ?? 'images/background/bg-11.jpg') }});">
            <div class="row project-detail-row">
                <div class="col-lg-6 col-md-12 project-detail-pic">
                    @php $sliderItems = $project->sliderItems(); @endphp
                    @if($sliderItems->isNotEmpty())
                    <div class="project-detail-carousel-wrap">
                        <div class="owl-carousel project-detail-carousel owl-btn-bottom-right">
                            @foreach($sliderItems as $slide)
                            <div class="item">
                                <div class="project-detail-slide{{ $slide->youtube_url ? ' project-detail-slide--has-video' : '' }}">
                                    <img src="{{ media_url($slide->image) }}" alt="{{ $project->title }}">
                                    @if($slide->youtube_url && youtube_embed_url($slide->youtube_url))
                                    <button
                                        type="button"
                                        class="project-detail-video-play"
                                        data-video-url="{{ youtube_embed_url($slide->youtube_url) }}"
                                        aria-label="Play video"
                                    >
                                        <span class="project-detail-video-play__rings" aria-hidden="true">
                                            <span class="project-detail-video-play__ring"></span>
                                            <span class="project-detail-video-play__ring"></span>
                                        </span>
                                        <span class="project-detail-video-play__core">
                                            <span class="project-detail-video-play__icon">
                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="M8 5.14v13.72c0 .79.87 1.27 1.54.84l11.14-6.86c.6-.37.6-1.27 0-1.64L9.54 4.3C8.87 3.87 8 4.35 8 5.14z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="project-detail-video-play__label">Watch Video</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="project-detail-slide project-detail-slide--fallback" style="background-image:url({{ media_url('images/gallery/portrait/pic1.jpg') }});"></div>
                    @endif
                </div>
                <div class="col-lg-6 col-md-12 project-detail-containt square_shape3">
                    <div class="p-lr20 p-tb80 project-detail-containt-info bg-black">
                        <div class="bg-white p-lr30 p-tb50 text-black">
                            <h2 class="m-t0"><span class="font-34 text-uppercase">{{ $project->title }}</span></h2>
                            <div class="project-description">{!! $project->description !!}</div>
                            <div class="product-block">
                                <div class="row">
                                    @if($project->project_date)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Date</h5>
                                        <p>{{ $project->project_date->format('F d, Y') }}</p>
                                    </div>
                                    @endif
                                    @if($project->client)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Client</h5>
                                        <p>{{ $project->client }}</p>
                                    </div>
                                    @endif
                                    @if($project->project_type)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Project type</h5>
                                        <p>{{ $project->project_type }}</p>
                                    </div>
                                    @endif
                                    @if($project->creative_director)
                                    <div class="col-md-6 col-sm-6 m-b30">
                                        <h5 class="text-uppercase">Creative Director</h5>
                                        <p>{{ $project->creative_director }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-t0">
                                <ul class="social-icons social-square social-darkest m-b0">
                                    @if(setting('facebook'))<li><a href="{{ setting('facebook') }}" class="fa fa-facebook"></a></li>@endif
                                    @if(setting('twitter'))<li><a href="{{ setting('twitter') }}" class="fa fa-twitter"></a></li>@endif
                                    @if(setting('linkedin'))<li><a href="{{ setting('linkedin') }}" class="fa fa-linkedin"></a></li>@endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="project-video-modal" class="project-video-modal" hidden aria-hidden="true">
    <div class="project-video-modal__backdrop" data-project-video-close></div>
    <div class="project-video-modal__dialog" role="dialog" aria-modal="true" aria-label="Project video">
        <button type="button" class="project-video-modal__close" data-project-video-close aria-label="Close video">
            <i class="fa fa-times"></i>
        </button>
        <div class="project-video-modal__iframe-wrap">
            <iframe id="project-video-iframe" src="" title="Project video player" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.project-detail-outer {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    overflow: hidden;
}

.project-detail-row {
    align-items: stretch;
    margin-left: 0;
    margin-right: 0;
}

.project-detail-row > [class*="col-"] {
    padding-left: 0;
    padding-right: 0;
}

.project-detail-pic {
    position: relative;
    min-height: 480px;
    overflow: hidden;
}

.project-detail-carousel-wrap {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 480px;
}

.project-detail-slide {
    width: 100%;
    height: 480px;
    overflow: hidden;
    background-color: #111;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.project-detail-slide img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center center;
}

.project-detail-slide--fallback {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    min-height: 480px;
}

.project-detail-carousel,
.project-detail-carousel .owl-stage-outer,
.project-detail-carousel .owl-stage,
.project-detail-carousel .owl-item,
.project-detail-carousel .item {
    height: 100%;
}

.project-detail-carousel .owl-nav {
    margin: 0;
}

.project-detail-carousel .owl-nav button.owl-prev,
.project-detail-carousel .owl-nav button.owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    margin: 0;
}

.project-detail-carousel .owl-nav button.owl-prev {
    left: 12px;
}

.project-detail-carousel .owl-nav button.owl-next {
    right: 12px;
}

.project-detail-containt-info {
    height: 100%;
}

.project-detail-slide--has-video::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.08) 35%, rgba(0, 0, 0, 0.55) 100%);
    pointer-events: none;
    transition: opacity 0.35s ease;
}

.project-detail-slide--has-video:hover::after {
    opacity: 0.92;
}

.project-detail-video-play {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 2;
    width: 5.5rem;
    height: 5.5rem;
    margin: 0;
    padding: 0;
    border: 0;
    background: transparent;
    color: #fff;
    transform: translate(-50%, -50%);
    cursor: pointer;
}

.project-detail-video-play__rings {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.project-detail-video-play__ring {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.45);
    opacity: 0;
    animation: project-video-ring-pulse 2.4s ease-out infinite;
}

.project-detail-video-play__ring:nth-child(2) {
    animation-delay: 1.2s;
}

.project-detail-video-play__core {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.22) 0%, rgba(255, 255, 255, 0.08) 100%);
    border: 1px solid rgba(255, 255, 255, 0.38);
    box-shadow:
        0 12px 40px rgba(0, 0, 0, 0.35),
        inset 0 1px 0 rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, background 0.35s ease;
}

.project-detail-video-play__core::before {
    content: "";
    position: absolute;
    inset: 0.45rem;
    border-radius: 50%;
    background: linear-gradient(145deg, #ff4b52 0%, #e31e24 48%, #b9151a 100%);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.project-detail-video-play__icon {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 1.35rem;
    height: 1.35rem;
    margin-left: 0.2rem;
    color: #fff;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.25));
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.project-detail-video-play__icon svg {
    width: 100%;
    height: 100%;
    display: block;
}

.project-detail-video-play__label {
    position: absolute;
    top: calc(100% + 0.85rem);
    left: 50%;
    z-index: 1;
    padding: 0.45rem 1rem;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    white-space: nowrap;
    color: #fff;
    background: rgba(0, 0, 0, 0.42);
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 999px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
    opacity: 0;
    transform: translateX(-50%) translateY(8px);
    transition: opacity 0.35s ease, transform 0.35s ease;
    pointer-events: none;
}

.project-detail-video-play:hover .project-detail-video-play__core,
.project-detail-video-play:focus-visible .project-detail-video-play__core {
    transform: scale(1.08);
    box-shadow:
        0 18px 50px rgba(227, 30, 36, 0.35),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.project-detail-video-play:hover .project-detail-video-play__core::before,
.project-detail-video-play:focus-visible .project-detail-video-play__core::before {
    transform: scale(1.04);
}

.project-detail-video-play:hover .project-detail-video-play__icon,
.project-detail-video-play:focus-visible .project-detail-video-play__icon {
    transform: scale(1.12);
}

.project-detail-video-play:hover .project-detail-video-play__label,
.project-detail-video-play:focus-visible .project-detail-video-play__label {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

.project-detail-video-play:focus-visible {
    outline: none;
}

.project-detail-video-play:focus-visible .project-detail-video-play__core {
    outline: 2px solid rgba(255, 255, 255, 0.85);
    outline-offset: 4px;
}

@keyframes project-video-ring-pulse {
    0% {
        transform: scale(0.82);
        opacity: 0.75;
    }
    70% {
        transform: scale(1.45);
        opacity: 0;
    }
    100% {
        transform: scale(1.45);
        opacity: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    .project-detail-video-play__ring {
        animation: none;
        opacity: 0.35;
    }

    .project-detail-video-play__core,
    .project-detail-video-play__icon,
    .project-detail-video-play__label {
        transition: none;
    }
}

.project-video-modal {
    position: fixed;
    inset: 0;
    z-index: 10050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}

.project-video-modal[hidden] {
    display: none !important;
}

body.project-video-modal-open {
    overflow: hidden;
}

.project-video-modal__backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.82);
}

.project-video-modal__dialog {
    position: relative;
    width: min(960px, 100%);
    z-index: 1;
}

.project-video-modal__close {
    position: absolute;
    top: -2.75rem;
    right: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.25rem;
    height: 2.25rem;
    border: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.14);
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s ease;
}

.project-video-modal__close:hover {
    background: rgba(255, 255, 255, 0.24);
}

.project-video-modal__iframe-wrap {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    background: #000;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
}

.project-video-modal__iframe-wrap iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

@media only screen and (max-width: 991px) {
    .project-detail-pic,
    .project-detail-carousel-wrap {
        min-height: 360px;
    }

    .project-detail-slide,
    .project-detail-slide--fallback {
        height: 360px;
        min-height: 360px;
    }

    .project-detail-video-play {
        width: 4.5rem;
        height: 4.5rem;
    }

    .project-detail-video-play__label {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        font-size: 0.65rem;
        padding: 0.35rem 0.8rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    var $carousel = $('.project-detail-carousel');
    var $modal = $('#project-video-modal');
    var $iframe = $('#project-video-iframe');

    function stopProjectVideo() {
        $iframe.attr('src', '');
        $modal.attr('hidden', true).attr('aria-hidden', 'true');
        $('body').removeClass('project-video-modal-open');
    }

    function openProjectVideo(url) {
        if (!url) {
            return;
        }

        $iframe.attr('src', url);
        $modal.removeAttr('hidden').attr('aria-hidden', 'false');
        $('body').addClass('project-video-modal-open');
    }

    $(document).on('click', '.project-detail-video-play', function (event) {
        event.preventDefault();
        event.stopPropagation();
        openProjectVideo($(this).data('video-url'));
    });

    $(document).on('click', '[data-project-video-close]', stopProjectVideo);

    $(document).on('keydown', function (event) {
        if (event.key === 'Escape' && !$modal.is('[hidden]')) {
            stopProjectVideo();
        }
    });

    $(window).on('beforeunload pagehide', stopProjectVideo);

    function syncProjectDetailHeight() {
        var $pic = $('.project-detail-pic');
        var $content = $('.project-detail-containt');
        var minHeight = window.innerWidth >= 992 ? 480 : 360;
        var contentHeight = $content.outerHeight() || minHeight;
        var targetHeight = Math.max(contentHeight, minHeight);

        $pic.css('min-height', targetHeight);
        $('.project-detail-carousel-wrap').css('min-height', targetHeight);
        $('.project-detail-slide').css('height', targetHeight);

        if ($carousel.length && $carousel.hasClass('owl-loaded')) {
            $carousel.trigger('refresh.owl.carousel');
        }
    }

    if ($carousel.length) {
        $carousel.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            margin: 0,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: false,
            onInitialized: syncProjectDetailHeight,
            onResized: syncProjectDetailHeight,
        });
    }

    syncProjectDetailHeight();
    $(window).on('load resize', syncProjectDetailHeight);
});
</script>
@endpush
