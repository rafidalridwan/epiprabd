<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', setting('og_description', setting('site_name')))">
    <title>@yield('title', setting('site_name', 'Modern Template'))</title>
    @include('partials.seo-meta')
    @include('partials.favicon')
    @include('partials.nprogress')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-ios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/whatsapp-widget.css') }}">
    @stack('styles')
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,800,800i,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&subset=latin-ext" rel="stylesheet">
</head>
<body @yield('body_attrs')>
<div class="page-wraper">
    @include('partials.header')
    <div class="page-content">
        @yield('content')
    </div>
    @include('partials.footer')
    <button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>
    @include('partials.whatsapp-widget')
</div>
@include('partials.scripts')
<script src="{{ asset('js/footer-particles.js') }}"></script>
<script src="{{ asset('js/whatsapp-widget.js') }}"></script>
@stack('scripts')
</body>
</html>
