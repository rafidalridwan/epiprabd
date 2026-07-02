(function () {
    'use strict';

    if (!document.body.classList.contains('page-home')) {
        return;
    }

    var panel = document.getElementById('home-hero-panel');
    var progressEl = document.getElementById('home-hero-progress');
    var titleEl = panel ? panel.querySelector('.home-hero-panel__title') : null;
    var subtitleEl = panel ? panel.querySelector('.home-hero-panel__subtitle') : null;
    var linkEl = panel ? panel.querySelector('.home-hero-panel__link') : null;
    var slides = [];
    var slideDelay = 5000;
    var activeIndex = 0;

    function collectSlides() {
        slides = Array.prototype.slice.call(
            document.querySelectorAll('#welcome > ul > li[data-mad-title]')
        );
    }

    function getActiveIndex() {
        var active = document.querySelector('#welcome .active-revslide');
        if (!active) {
            return 0;
        }

        var index = slides.indexOf(active);
        return index >= 0 ? index : 0;
    }

    function buildProgressBars() {
        if (!progressEl) {
            return;
        }

        collectSlides();
        progressEl.innerHTML = '';

        slides.forEach(function (slide, index) {
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'home-hero-panel__bar' + (index === activeIndex ? ' is-active' : '');
            button.setAttribute('aria-label', 'Go to slide ' + (index + 1));
            button.innerHTML =
                '<span class="home-hero-panel__bar-track">' +
                    '<span class="home-hero-panel__bar-fill"></span>' +
                '</span>';

            button.addEventListener('click', function () {
                goToSlide(index);
            });

            progressEl.appendChild(button);
        });
    }

    function goToSlide(index) {
        if (typeof revapi318 === 'undefined' || !revapi318) {
            return;
        }

        if (typeof revapi318.revshowslide === 'function') {
            revapi318.revshowslide(index + 1);
        }
    }

    function resetProgressFills() {
        if (!progressEl) {
            return;
        }

        progressEl.querySelectorAll('.home-hero-panel__bar').forEach(function (bar, index) {
            bar.classList.toggle('is-active', index === activeIndex);
            bar.style.opacity = index === activeIndex ? '1' : '0.2';

            var fill = bar.querySelector('.home-hero-panel__bar-fill');
            if (!fill) {
                return;
            }

            fill.style.transition = 'none';
            fill.style.width = '0%';
        });
    }

    function startProgress() {
        if (!progressEl) {
            return;
        }

        var bar = progressEl.querySelectorAll('.home-hero-panel__bar')[activeIndex];
        if (!bar) {
            return;
        }

        var fill = bar.querySelector('.home-hero-panel__bar-fill');
        if (!fill) {
            return;
        }

        fill.style.transition = 'none';
        fill.style.width = '0%';
        void fill.offsetWidth;
        fill.style.transition = 'width ' + slideDelay + 'ms linear';
        fill.style.width = '100%';
    }

    function updatePanel() {
        activeIndex = getActiveIndex();
        var slide = slides[activeIndex];

        if (!slide || !panel) {
            return;
        }

        if (titleEl) {
            titleEl.textContent = slide.getAttribute('data-mad-title') || '';
        }

        if (subtitleEl) {
            var subtitle = (slide.getAttribute('data-mad-subtitle') || '').trim();
            subtitleEl.textContent = subtitle;
            subtitleEl.hidden = !subtitle;
        }

        if (linkEl) {
            linkEl.href = slide.getAttribute('data-mad-link') || '#';
        }

        resetProgressFills();
        startProgress();
    }

    function showPanel() {
        if (panel) {
            panel.classList.add('is-visible');
        }
        updatePanel();
    }

    function bindRevSlider() {
        if (typeof revapi318 === 'undefined' || !revapi318) {
            return false;
        }

        if (typeof revapi318.revmaxdelay === 'function') {
            slideDelay = revapi318.revmaxdelay() || slideDelay;
        }

        buildProgressBars();

        revapi318.bind('revolution.slide.onloaded', function () {
            window.setTimeout(showPanel, 700);
        });

        revapi318.bind('revolution.slide.onafterswap', function () {
            updatePanel();
        });

        if (document.querySelector('#welcome .active-revslide')) {
            window.setTimeout(showPanel, 700);
        }

        return true;
    }

    if (!bindRevSlider()) {
        var attempts = 0;
        var timer = window.setInterval(function () {
            attempts += 1;
            if (bindRevSlider() || attempts > 80) {
                window.clearInterval(timer);
            }
        }, 100);
    }
})();
