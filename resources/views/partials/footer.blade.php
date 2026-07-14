@php
    $footerLogo = setting('footer_logo') ?: setting('logo');
    $serviceLinks = footer_menu_links(setting('footer_services'));
    $quickLinks = footer_menu_links(setting('footer_quick_links'));

    if (empty($serviceLinks)) {
        $serviceLinks = [
            ['label' => 'Architecture', 'url' => '#'],
            ['label' => '3D Animation', 'url' => '#'],
            ['label' => 'House Planning', 'url' => '#'],
            ['label' => 'Interior Design', 'url' => '#'],
            ['label' => 'Construction', 'url' => '#'],
        ];
    }

    if (empty($quickLinks)) {
        $quickLinks = [
            ['label' => 'About Us', 'url' => route('about')],
            ['label' => 'Contact Us', 'url' => route('contact')],
            ['label' => 'Our Services', 'url' => route('services')],
            ['label' => 'Terms & Condition', 'url' => '#'],
            ['label' => 'Support', 'url' => route('contact')],
        ];
    }
@endphp

<footer class="site-footer-modern">
    <canvas class="site-footer-modern__particles" id="footer-particles" aria-hidden="true"></canvas>
    <div class="site-footer-modern__main">
        <div class="container">
            <div class="row site-footer-modern__grid">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 site-footer-modern__col site-footer-modern__col--logo">
                    <a href="{{ route('home') }}" class="site-footer-modern__logo">
                        <img src="{{ media_url($footerLogo, 'images/logo-dark.png') }}" alt="{{ setting('site_name') }}">
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 site-footer-modern__col">
                    <h4 class="site-footer-modern__title">Address</h4>
                    <ul class="site-footer-modern__contact">
                        @if(setting('site_address'))
                        <li>
                            <span class="site-footer-modern__icon"><i class="fa fa-map-marker"></i></span>
                            <span>{{ setting('site_address') }}</span>
                        </li>
                        @endif
                        @if(setting('site_phone'))
                        <li>
                            <span class="site-footer-modern__icon"><i class="fa fa-phone"></i></span>
                            <a href="tel:{{ preg_replace('/\s+/', '', setting('site_phone')) }}">{{ setting('site_phone') }}</a>
                        </li>
                        @endif
                        @if(setting('site_email'))
                        <li>
                            <span class="site-footer-modern__icon"><i class="fa fa-envelope"></i></span>
                            <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a>
                        </li>
                        @endif
                    </ul>
                    <div class="site-footer-modern__social">
                        @if(setting('facebook'))<a href="{{ setting('facebook') }}" class="site-footer-modern__social-link" aria-label="Facebook"><i class="fa fa-facebook"></i></a>@endif
                        @if(setting('youtube'))<a href="{{ setting('youtube') }}" class="site-footer-modern__social-link" aria-label="YouTube"><i class="fa fa-youtube"></i></a>@endif
                        @if(setting('linkedin'))<a href="{{ setting('linkedin') }}" class="site-footer-modern__social-link" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>@endif
                        @if(setting('instagram'))<a href="{{ setting('instagram') }}" class="site-footer-modern__social-link" aria-label="Instagram"><i class="fa fa-instagram"></i></a>@endif
                        @if(setting('twitter'))<a href="{{ setting('twitter') }}" class="site-footer-modern__social-link" aria-label="Twitter"><i class="fa fa-twitter"></i></a>@endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 site-footer-modern__col">
                    <h4 class="site-footer-modern__title">Services</h4>
                    <ul class="site-footer-modern__links">
                        @foreach($serviceLinks as $link)
                        <li><a href="{{ $link['url'] }}"><i class="fa fa-angle-right"></i>{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 site-footer-modern__col">
                    <h4 class="site-footer-modern__title">Quick Links</h4>
                    <ul class="site-footer-modern__links">
                        @foreach($quickLinks as $link)
                        <li><a href="{{ $link['url'] }}"><i class="fa fa-angle-right"></i>{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-footer-modern__scene" aria-hidden="true">
            <div class="site-footer-modern__scene-bg"></div>
            <div class="site-footer-modern__scene-car"></div>
            <div class="site-footer-modern__scene-cyclist"></div>
        </div>
    </div>

    <div class="site-footer-modern__bottom">
        <div class="container">
            <div class="site-footer-modern__bottom-inner">
                <span class="site-footer-modern__copyright">
                    {{ setting('footer_text', 'Copyright © ' . date('Y') . ' ' . setting('site_name')) }}
                    <span class="site-footer-modern__credit">
                        Designed by <a href="https://rafidalridwan.github.io/" target="_blank" rel="noopener noreferrer">RAR</a>
                    </span>
                </span>
                <button type="button" class="scroltop site-footer-modern__top" aria-label="Back to top">
                    <i class="fa fa-angle-up"></i>
                </button>
            </div>
        </div>
    </div>
</footer>
