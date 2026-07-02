(function () {
    'use strict';

    if (!document.body.classList.contains('page-home')) {
        return;
    }

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var header = document.querySelector('.site-header--hero');
    var headerWrap = document.querySelector('.site-header--hero .main-bar-wraper');
    var wrapper = document.getElementById('welcome_wrapper');
    var sliderReady = false;

    function syncHeaderHeight() {
        if (!headerWrap) {
            return;
        }

        document.documentElement.style.setProperty(
            '--home-header-height',
            headerWrap.offsetHeight + 'px'
        );

        if (typeof revapi318 !== 'undefined' && revapi318 && revapi318.revredraw) {
            revapi318.revredraw();
        }
    }

    function onHomeScroll() {
        if (!headerWrap) {
            return;
        }

        if (window.scrollY >= 12) {
            headerWrap.classList.add('is-header-scrolled');
        } else {
            headerWrap.classList.remove('is-header-scrolled');
        }

        if (headerWrap.classList.contains('is-fixed')) {
            syncHeaderHeight();
        }
    }

    function revealSlider() {
        if (!wrapper || sliderReady) {
            return;
        }

        sliderReady = true;

        var introDelay = reduceMotion ? 0 : 520;

        window.setTimeout(function () {
            wrapper.classList.add('is-hero-intro');

            window.setTimeout(function () {
                wrapper.classList.add('is-hero-zoom-ready');
            }, reduceMotion ? 0 : 2400);
        }, introDelay);
    }

    function startHeaderIntro() {
        if (!header || header.classList.contains('is-header-intro')) {
            return;
        }

        header.classList.add('is-header-intro');
    }

    function bindRevSlider() {
        if (typeof revapi318 === 'undefined' || !revapi318) {
            return false;
        }

        revapi318.bind('revolution.slide.onloaded', function () {
            syncHeaderHeight();
            revealSlider();
        });

        if (wrapper && wrapper.querySelector('.active-revslide')) {
            revealSlider();
        }

        return true;
    }

    syncHeaderHeight();
    window.addEventListener('resize', syncHeaderHeight);
    window.addEventListener('scroll', onHomeScroll, { passive: true });
    onHomeScroll();
    startHeaderIntro();

    if (reduceMotion) {
        revealSlider();
        wrapper.classList.add('is-hero-zoom-ready');
        return;
    }

    if (!bindRevSlider()) {
        var attempts = 0;
        var timer = window.setInterval(function () {
            attempts += 1;
            if (bindRevSlider() || attempts > 80) {
                window.clearInterval(timer);
                revealSlider();
            }
        }, 100);
    }

    window.setTimeout(revealSlider, 2500);
})();
