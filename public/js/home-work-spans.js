(function () {
    'use strict';

    var section = document.querySelector('[data-work-spans]');
    var panelsWrap = document.querySelector('[data-work-spans-panels]');

    if (!section || !panelsWrap) {
        return;
    }

    var panels = Array.prototype.slice.call(panelsWrap.querySelectorAll('[data-work-spans-panel]'));
    var panelCount = panels.length;

    if (!panelCount) {
        return;
    }

    var expandedWidth = 50;
    var collapsedWidth = (100 - expandedWidth) / (panelCount - 1);
    var equalWidth = 100 / panelCount;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function setPanelWidths(activeIndex) {
        panels.forEach(function (panel, index) {
            var width = typeof activeIndex === 'number'
                ? (index === activeIndex ? expandedWidth : collapsedWidth)
                : equalWidth;

            panel.style.width = width + '%';
            panel.classList.toggle('is-active', typeof activeIndex === 'number' && index === activeIndex);
        });

        panelsWrap.classList.toggle('is-hovering', typeof activeIndex === 'number');
    }

    function resetPanels() {
        setPanelWidths(null);
    }

    setPanelWidths(null);

    if (!reduceMotion) {
        panels.forEach(function (panel, index) {
            panel.addEventListener('mouseenter', function () {
                setPanelWidths(index);
            });
        });

        panelsWrap.addEventListener('mouseleave', resetPanels);
    }

    if ('IntersectionObserver' in window && !reduceMotion) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    section.classList.add('is-visible');
                    observer.unobserve(section);
                }
            });
        }, { threshold: 0.25 });

        observer.observe(section);
    } else {
        section.classList.add('is-visible');
    }
})();
