(function () {
    'use strict';

    if (typeof NProgress === 'undefined') {
        return;
    }

    NProgress.configure({
        showSpinner: false,
        minimum: 0.12,
        trickleSpeed: 140,
        easing: 'ease',
        speed: 320,
    });

    function shouldTrackLink(link) {
        if (!link || link.target === '_blank' || link.hasAttribute('download')) {
            return false;
        }

        var href = link.getAttribute('href');

        if (!href || href.charAt(0) === '#' || href.indexOf('javascript:') === 0) {
            return false;
        }

        if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) {
            return false;
        }

        try {
            var url = new URL(link.href, window.location.href);
            return url.origin === window.location.origin;
        } catch (error) {
            return false;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        NProgress.start();
    });

    window.addEventListener('load', function () {
        NProgress.done();
    });

    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href]');

        if (!shouldTrackLink(link)) {
            return;
        }

        NProgress.start();
    });

    document.addEventListener('submit', function (event) {
        var form = event.target;

        if (!(form instanceof HTMLFormElement) || form.target === '_blank') {
            return;
        }

        NProgress.start();
    });

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            NProgress.done();
        }
    });
})();
