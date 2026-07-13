<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <div class="brand-icon"><i class="fa fa-cube"></i></div>
            <div>
                <div class="brand-text">{{ setting('site_name', 'Modern') }}</div>
                <div class="brand-sub">Admin Panel</div>
            </div>
        </a>
    </div>

    <nav class="admin-nav">
        <div class="admin-nav-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i> Dashboard
        </a>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fa fa-envelope"></i> Messages
            @if(($unreadMessages ?? 0) > 0)
            <span class="nav-badge">{{ $unreadMessages }}</span>
            @endif
        </a>
        <a href="{{ route('admin.applications.index') }}" class="{{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fa fa-file-text-o"></i> Applications
            @if(($unreadApplications ?? 0) > 0)
            <span class="nav-badge">{{ $unreadApplications }}</span>
            @endif
        </a>

        <div class="admin-nav-label">Content</div>
        <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="fa fa-file-text"></i> Pages
        </a>
        <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <i class="fa fa-picture-o"></i> Home Sliders
        </a>
        <a href="{{ route('admin.home-cards.index') }}" class="{{ request()->routeIs('admin.home-cards.*') ? 'active' : '' }}">
            <i class="fa fa-th-large"></i> Home Cards
        </a>
        <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fa fa-briefcase"></i> Projects
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fa fa-tags"></i> Categories
        </a>
        <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
            <i class="fa fa-users"></i> Team Members
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="fa fa-quote-left"></i> Testimonials
        </a>
        <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
            <i class="fa fa-building-o"></i> Clients
        </a>
        <a href="{{ route('admin.jobs.index') }}" class="{{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
            <i class="fa fa-id-card-o"></i> Job Circulars
        </a>

        <div class="admin-nav-label">System</div>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fa fa-cog"></i> Site Settings
        </a>
        <a href="{{ route('home') }}" target="_blank">
            <i class="fa fa-external-link"></i> View Website
        </a>
    </nav>

    <div class="admin-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-btn admin-btn-ghost" style="width:100%;color:#cbd5e1;border-color:rgba(255,255,255,0.15);">
                <i class="fa fa-sign-out"></i> Logout
            </button>
        </form>
    </div>
</aside>
