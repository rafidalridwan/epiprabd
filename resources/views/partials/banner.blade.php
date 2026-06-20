<div class="wt-bnr-inr overlay-wraper bg-parallax bg-top-center" data-stellar-background-ratio="0.5" style="background-image:url({{ media_url($bannerImage ?? 'images/background/bg-11.jpg') }});">
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="text-white text-uppercase letter-spacing-5 font-18 font-weight-300">{{ $bannerTitle }}</h2>
                </div>
            </div>
            <div class="p-tb20">
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $breadcrumb }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>