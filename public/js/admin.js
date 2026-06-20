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
});
