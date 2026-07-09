(function () {
    'use strict';

    var INTERACTIVE_SELECTOR = 'a, button, input, select, textarea, [role="button"], .site-button, .scroltop, label[for]';

    function isPointerDevice() {
        return window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    }

    function isInteractive(el) {
        return el && el.closest && el.closest(INTERACTIVE_SELECTOR);
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!isPointerDevice()) {
            return;
        }

        var dot = document.getElementById('cursor-dot');
        var ring = document.getElementById('cursor-ring');

        if (!dot || !ring) {
            return;
        }

        document.documentElement.classList.add('custom-cursor-enabled');

        var mouseX = window.innerWidth / 2;
        var mouseY = window.innerHeight / 2;
        var ringX = mouseX;
        var ringY = mouseY;

        window.addEventListener('mousemove', function (e) {
            mouseX = e.clientX;
            mouseY = e.clientY;

            dot.style.left = mouseX + 'px';
            dot.style.top = mouseY + 'px';

            var target = document.elementFromPoint(mouseX, mouseY);
            ring.classList.toggle('hover', !!isInteractive(target));
        });

        function animate() {
            var ease = 0.15;
            ringX += (mouseX - ringX) * ease;
            ringY += (mouseY - ringY) * ease;
            ring.style.left = ringX + 'px';
            ring.style.top = ringY + 'px';
            requestAnimationFrame(animate);
        }

        animate();
    });
})();
