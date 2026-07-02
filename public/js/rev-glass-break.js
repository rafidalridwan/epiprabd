(function ($) {
    'use strict';

    var COLS = 7;
    var ROWS = 4;
    var DURATION_MS = 850;
    var sliderReady = false;
    var swapCount = 0;

    function jitterPercent(min, max) {
        return (min + Math.random() * (max - min)).toFixed(1);
    }

    function shardClipPath() {
        return 'polygon(' +
            jitterPercent(0, 25) + '% 0%, 100% ' + jitterPercent(0, 25) + '%, ' +
            jitterPercent(75, 100) + '% 100%, 0% ' + jitterPercent(75, 100) + '%)';
    }

    function parseBackgroundImage(value) {
        if (!value || value === 'none') {
            return '';
        }

        var match = value.match(/url\(["']?(.*?)["']?\)/);
        return match ? match[1] : '';
    }

    function getSlideImageUrl($slide) {
        if (!$slide || !$slide.length) {
            return '';
        }

        var $bg = $slide.find('.tp-bgimg').first();
        var $img = $slide.find('.rev-slidebg').first();
        var url = parseBackgroundImage($bg.css('background-image'));

        if (!url && $img.length) {
            url = $img.attr('src') || $img.data('lazyload') || '';
        }

        return url;
    }

    function playGlassBreak($overlay, $slider, imgUrl) {
        if (!imgUrl || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        var width = $slider.width();
        var height = $slider.height();

        if (!width || !height) {
            return;
        }

        var shardWidth = width / COLS;
        var shardHeight = height / ROWS;
        var clip = shardClipPath();

        $overlay.empty().addClass('is-playing');
        $overlay.append('<div class="rev-glass-break__flash" aria-hidden="true"></div>');

        for (var row = 0; row < ROWS; row++) {
            for (var col = 0; col < COLS; col++) {
                var tx = ((Math.random() - 0.5) * width * 0.32).toFixed(1);
                var ty = ((Math.random() - 0.5) * height * 0.32).toFixed(1);
                var rot = ((Math.random() - 0.5) * 50).toFixed(1);
                var delay = Math.floor(Math.random() * 120);

                $('<div class="rev-glass-break__shard"></div>').css({
                    left: (col * shardWidth) + 'px',
                    top: (row * shardHeight) + 'px',
                    width: (shardWidth + 2) + 'px',
                    height: (shardHeight + 2) + 'px',
                    backgroundImage: 'url("' + imgUrl + '")',
                    backgroundSize: width + 'px ' + height + 'px',
                    backgroundPosition: (-col * shardWidth) + 'px ' + (-row * shardHeight) + 'px',
                    clipPath: clip,
                    WebkitClipPath: clip,
                    '--tx': tx + 'px',
                    '--ty': ty + 'px',
                    '--rot': rot + 'deg',
                    animationDelay: delay + 'ms'
                }).appendTo($overlay);
            }
        }

        window.clearTimeout($overlay.data('clearTimer'));
        $overlay.data('clearTimer', window.setTimeout(function () {
            $overlay.removeClass('is-playing').empty();
        }, DURATION_MS));
    }

    function initGlassBreak(revapi) {
        if (document.body.classList.contains('page-home')) {
            return;
        }

        var $slider = $('#welcome');
        var $overlay = $('<div class="rev-glass-break" aria-hidden="true"></div>');

        if (!$slider.length || $slider.data('glassBreakReady')) {
            return;
        }

        $slider.append($overlay);
        $slider.data('glassBreakReady', true);

        revapi.bind('revolution.slide.onloaded', function () {
            sliderReady = true;
        });

        revapi.bind('revolution.slide.onbeforeswap', function (event, data) {
            if (!sliderReady || !data || !data.currentslide || !data.currentslide.length) {
                return;
            }

            swapCount += 1;
            if (swapCount < 2) {
                return;
            }

            var imgUrl = getSlideImageUrl(data.currentslide);

            window.requestAnimationFrame(function () {
                playGlassBreak($overlay, $slider, imgUrl);
            });
        });
    }

    function waitForRevapi() {
        var attempts = 0;
        var timer = window.setInterval(function () {
            if (typeof revapi318 !== 'undefined' && revapi318) {
                window.clearInterval(timer);
                initGlassBreak(revapi318);
                return;
            }

            attempts += 1;
            if (attempts > 60) {
                window.clearInterval(timer);
            }
        }, 100);
    }

    $(document).ready(waitForRevapi);
})(jQuery);
