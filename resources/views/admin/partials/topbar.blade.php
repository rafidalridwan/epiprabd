<header class="admin-topbar">
    <div class="admin-topbar-left">
        <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Toggle menu">
            <i class="fa fa-bars"></i>
        </button>
        @hasSection('breadcrumb')
        <nav class="admin-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="sep">/</span>
            @yield('breadcrumb')
        </nav>
        @endif
    </div>
    <div class="admin-topbar-right">
        <a href="{{ route('home') }}" target="_blank" class="admin-topbar-btn">
            <i class="fa fa-external-link"></i> View Site
        </a>
        <div class="admin-user-menu">
            <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div class="admin-user-info">
                <div class="admin-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="admin-user-role">Administrator</div>
            </div>
        </div>
    </div>
</header>
