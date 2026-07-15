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

    document.querySelectorAll('[data-multi-image-upload]').forEach(function (wrap) {
        const input = wrap.querySelector('[data-multi-image-input]');
        const previewGrid = wrap.querySelector('[data-gallery-preview]');
        const filenameEl = wrap.querySelector('[data-multi-image-filename]');
        const objectUrls = [];
        const enableVideo = !wrap.hasAttribute('data-multi-image-no-video');

        if (!input || !previewGrid) {
            return;
        }

        function revokeObjectUrls() {
            while (objectUrls.length) {
                URL.revokeObjectURL(objectUrls.pop());
            }
        }

        function clearPreview() {
            revokeObjectUrls();
            previewGrid.innerHTML = '';
            previewGrid.hidden = true;

            if (filenameEl) {
                filenameEl.textContent = 'No files chosen';
                filenameEl.classList.remove('is-selected');
            }
        }

        input.addEventListener('change', function () {
            const files = Array.from(input.files || []).filter(function (file) {
                return file.type.startsWith('image/');
            });

            clearPreview();

            if (!files.length) {
                input.value = '';
                return;
            }

            files.forEach(function (file) {
                const objectUrl = URL.createObjectURL(file);
                objectUrls.push(objectUrl);

                const item = document.createElement('div');
                item.className = enableVideo
                    ? 'admin-gallery-item admin-gallery-item--preview admin-gallery-item--editable'
                    : 'admin-gallery-item admin-gallery-item--preview';

                const frame = document.createElement('span');
                frame.className = 'admin-gallery-item-frame';

                const img = document.createElement('img');
                img.src = objectUrl;
                img.alt = file.name;

                frame.appendChild(img);
                item.appendChild(frame);

                if (enableVideo) {
                    const videoLabel = document.createElement('label');
                    videoLabel.className = 'admin-gallery-item-video-label';
                    videoLabel.textContent = 'YouTube link';

                    const videoInput = document.createElement('input');
                    videoInput.type = 'text';
                    videoInput.name = 'new_video_urls[]';
                    videoInput.className = 'admin-form-control admin-gallery-item-video-input';
                    videoInput.placeholder = 'https://youtube.com/watch?v=...';

                    item.appendChild(videoLabel);
                    item.appendChild(videoInput);
                }

                previewGrid.appendChild(item);
            });

            previewGrid.hidden = false;

            if (filenameEl) {
                filenameEl.textContent = files.length === 1
                    ? files[0].name
                    : files.length + ' files selected';
                filenameEl.classList.add('is-selected');
            }
        });
    });
});
