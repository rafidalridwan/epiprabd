(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var widget = document.getElementById('whatsapp-widget');
        var popup = document.getElementById('whatsapp-popup');
        var toggle = document.getElementById('whatsapp-toggle');

        if (!widget || !popup || !toggle) {
            return;
        }

        function openPopup() {
            popup.hidden = false;
            popup.setAttribute('aria-hidden', 'false');
            toggle.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
        }

        function closePopup() {
            popup.hidden = true;
            popup.setAttribute('aria-hidden', 'true');
            toggle.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
        }

        function togglePopup() {
            if (popup.hidden) {
                openPopup();
            } else {
                closePopup();
            }
        }

        toggle.addEventListener('click', function (event) {
            event.stopPropagation();
            togglePopup();
        });

        widget.querySelectorAll('[data-whatsapp-close]').forEach(function (button) {
            button.addEventListener('click', closePopup);
        });

        document.addEventListener('click', function (event) {
            if (!widget.contains(event.target)) {
                closePopup();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        });
    });
})();
