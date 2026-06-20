document.addEventListener('DOMContentLoaded', function () {
    // Dismiss alerts
    document.querySelectorAll('[data-dismiss="alert"]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const alert = btn.closest('.admin-alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-8px)';
                setTimeout(function () { alert.remove(); }, 300);
            }
        });
    });

    // Auto-dismiss success alerts after 5s
    document.querySelectorAll('.admin-alert-success[data-auto-dismiss]').forEach(function (alert) {
        setTimeout(function () {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(function () { alert.remove(); }, 300);
        }, 5000);
    });

    // Mobile sidebar toggle
    const toggle = document.getElementById('adminMenuToggle');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('adminOverlay');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay?.classList.toggle('show');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar?.classList.remove('open');
            overlay.classList.remove('show');
        });
    }

    document.querySelectorAll('[data-image-upload]').forEach(function (wrap) {
        const input = wrap.querySelector('[data-image-input]');
        const newPreview = wrap.querySelector('[data-image-preview-new]');
        const newImg = newPreview?.querySelector('img');
        const filenameEl = wrap.querySelector('[data-image-filename]');
        const clearBtn = wrap.querySelector('[data-image-clear]');
        let objectUrl = null;

        if (!input || !newPreview || !newImg) {
            return;
        }

        function revokeObjectUrl() {
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }
        }

        function resetSelection() {
            input.value = '';
            revokeObjectUrl();
            newImg.removeAttribute('src');
            newPreview.hidden = true;

            if (filenameEl) {
                filenameEl.textContent = 'No file chosen';
                filenameEl.classList.remove('is-selected');
            }
        }

        function showPreview(file) {
            revokeObjectUrl();
            objectUrl = URL.createObjectURL(file);

            newImg.onload = function () {
                newPreview.hidden = false;
            };

            newImg.onerror = function () {
                resetSelection();
            };

            newImg.src = objectUrl;

            if (newImg.complete) {
                newPreview.hidden = false;
            }

            if (filenameEl) {
                filenameEl.textContent = file.name;
                filenameEl.classList.add('is-selected');
            }
        }

        input.addEventListener('change', function () {
            const file = input.files?.[0];

            if (!file || !file.type.startsWith('image/')) {
                resetSelection();
                return;
            }

            showPreview(file);
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                resetSelection();
            });
        }
    });
});
