/**
 * Text-only rich text editor (Quill) — no image/file upload.
 * Add class "richtext-editor" to any textarea.
 * Optional: "richtext-simple" for a smaller toolbar, data-richtext-height="200"
 */
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Quill === 'undefined') {
        return;
    }

    const editors = [];

    document.querySelectorAll('textarea.richtext-editor').forEach(function (textarea) {
        textarea.style.display = 'none';

        const wrapper = document.createElement('div');
        wrapper.className = 'richtext-wrapper';

        const editorEl = document.createElement('div');
        editorEl.className = 'richtext-quill';

        const height = parseInt(textarea.dataset.richtextHeight || '280', 10);
        editorEl.style.minHeight = height + 'px';

        wrapper.appendChild(editorEl);
        textarea.parentNode.insertBefore(wrapper, textarea.nextSibling);

        const toolbarOptions = textarea.classList.contains('richtext-simple')
            ? [
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean'],
            ]
            : [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: [] }],
                ['link'],
                ['clean'],
            ];

        const quill = new Quill(editorEl, {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
            },
            placeholder: textarea.getAttribute('placeholder') || 'Write your content here...',
        });

        if (textarea.value.trim()) {
            quill.clipboard.dangerouslyPasteHTML(textarea.value);
        }

        // Block pasted images — text formatting only
        quill.clipboard.addMatcher('IMG', function () {
            return new Quill.import('delta')();
        });

        editors.push({ quill, textarea });
    });

    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function () {
            editors.forEach(function (item) {
                if (form.contains(item.textarea)) {
                    item.textarea.value = item.quill.root.innerHTML;
                }
            });
        });
    });
});
