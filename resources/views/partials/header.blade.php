<header class="site-header site-header--ios header-style-1 nav-wide mobile-sider-drawer-menu{{ request()->routeIs('home') ? ' site-header--hero' : '' }}">
    <div class="sticky-header main-bar-wraper">
        <div class="main-bar p-t10">
            <div class="container">
                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="{{ route('home') }}">
                            <img src="{{ media_url(setting('logo'), 'images/logo-dark.png') }}" width="171" height="49" alt="{{ setting('site_name') }}">
                        </a>
                    </div>
                </div>
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>
                <div class="header-nav navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li class="{{ request()->routeIs('projects.index', 'projects.show') ? 'active' : '' }}">
                            <a href="{{ route('projects.index') }}">Projects</a>
                        </li>
                        <li class="{{ request()->routeIs('projects.map') ? 'active' : '' }}">
                            <a href="{{ route('projects.map') }}">Project Map</a>
                        </li>
                        <li class="{{ request()->routeIs('career.*') || request()->routeIs('jobs.*') ? 'active' : '' }}">
                            <a href="{{ route('career.index') }}">Career</a>
                        </li>
                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="extra-nav">
                    <div class="extra-cell">
                        <div class="dropdown share-icon-btn">
                            <a href="javascript:;" class="site-search-btn dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-share-alt"></i></a>
                            <div class="dropdown-menu bg-white">
                                <div class="top-bar">
                                    <ul class="social-bx list-inline">
                                        @if(setting('facebook'))<li><a href="{{ setting('facebook') }}" class="fa fa-facebook"></a></li>@endif
                                        @if(setting('twitter'))<li><a href="{{ setting('twitter') }}" class="fa fa-twitter"></a></li>@endif
                                        @if(setting('linkedin'))<li><a href="{{ setting('linkedin') }}" class="fa fa-linkedin"></a></li>@endif
                                        @if(setting('rss'))<li><a href="{{ setting('rss') }}" class="fa fa-rss"></a></li>@endif
                                        @if(setting('youtube'))<li><a href="{{ setting('youtube') }}" class="fa fa-youtube"></a></li>@endif
                                        @if(setting('instagram'))<li><a href="{{ setting('instagram') }}" class="fa fa-instagram"></a></li>@endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>