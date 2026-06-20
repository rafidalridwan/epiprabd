<footer class="site-footer bg-gray footer-light footer-wide">
    <div class="footer-bottom overlay-wraper">
        <div class="overlay-main bg-black" style="opacity:0;"></div>
        <div class="container p-t30">
            <div class="footer-bottom-content d-flex align-items-center justify-content-between">
                <div class="wt-footer-bot-left">
                    <a href="{{ route('home') }}">
                        <img src="{{ media_url(setting('logo'), 'images/logo-dark.png') }}" width="140" height="58" alt="">
                    </a>
                </div>
                <div class="text-center copyright-block p-t15">
                    <span class="copyrights-text">{{ setting('footer_text', '© Modern Template') }}</span>
                </div>
                <div class="wt-footer-bot-right p-t15">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
