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
                    @php $sliderImages = $project->sliderImages(); @endphp
                    @if($sliderImages->isNotEmpty())
                    <div class="project-detail-carousel-wrap">
                        <div class="owl-carousel project-detail-carousel owl-btn-bottom-right">
                            @foreach($sliderImages as $imagePath)
                            <div class="item">
                                <div class="project-detail-slide">
                                    <img src="{{ media_url($imagePath) }}" alt="{{ $project->title }}">
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
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    var $carousel = $('.project-detail-carousel');

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
