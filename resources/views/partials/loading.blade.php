@php
    $loaderLogo = setting('footer_logo') ?: setting('logo');
@endphp
<div class="loading-area" id="site-loader">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="site-loader" aria-hidden="true">
            <img
                src="{{ media_url($loaderLogo, 'images/logo-dark.png') }}"
                alt="{{ setting('site_name', 'Loading') }}"
                class="site-loader__logo{{ $loaderLogo ? '' : ' site-loader__logo--fallback' }}"
            >
        </div>
    </div>
</div>
