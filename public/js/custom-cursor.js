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

        var mouseX = 0;
        var mouseY = 0;
        var ringX = 0;
        var ringY = 0;
        var visible = false;
        var hasMoved = false;

        function showCursor() {
            if (visible) {
                return;
            }
            visible = true;
            dot.classList.add('is-visible');
            ring.classList.add('is-visible');
        }

        function hideCursor() {
            if (!visible) {
                return;
            }
            visible = false;
            dot.classList.remove('is-visible');
            ring.classList.remove('is-visible');
        }

        window.addEventListener('mousemove', function (e) {
            mouseX = e.clientX;
            mouseY = e.clientY;

            if (!hasMoved) {
                hasMoved = true;
                ringX = mouseX;
                ringY = mouseY;
            }

            showCursor();

            dot.style.left = mouseX + 'px';
            dot.style.top = mouseY + 'px';

            var target = document.elementFromPoint(mouseX, mouseY);
            ring.classList.toggle('hover', !!isInteractive(target));
        });

        document.documentElement.addEventListener('mouseleave', hideCursor);
        window.addEventListener('blur', hideCursor);

        function animate() {
            if (hasMoved) {
                var ease = 0.15;
                ringX += (mouseX - ringX) * ease;
                ringY += (mouseY - ringY) * ease;
                ring.style.left = ringX + 'px';
                ring.style.top = ringY + 'px';
            }
            requestAnimationFrame(animate);
        }

        animate();
    });
})();
