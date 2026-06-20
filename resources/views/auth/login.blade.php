<x-admin-auth-layout>
    <div class="admin-auth-body">
        <div class="admin-auth-left">
            <div class="admin-auth-left-content">
                <h1>Manage your website with ease</h1>
                <p>Sign in to update pages, projects, team members, sliders, and contact messages — all from one place.</p>
                <ul class="admin-auth-features">
                    <li><i class="fa fa-check"></i> Update content without touching code</li>
                    <li><i class="fa fa-check"></i> Manage projects &amp; portfolio</li>
                    <li><i class="fa fa-check"></i> View contact form submissions</li>
                    <li><i class="fa fa-check"></i> Control site settings &amp; branding</li>
                </ul>
            </div>
        </div>

        <div class="admin-auth-right">
            <div class="admin-auth-card">
                <div class="admin-auth-logo">
                    <div class="icon"><i class="fa fa-cube"></i></div>
                    <span>{{ setting('site_name', config('app.name')) }}</span>
                </div>

                <h2>Sign in</h2>
                <p class="subtitle">Enter your credentials to access the admin panel</p>

                @if(session('status'))
                <div class="admin-alerts" style="margin-bottom:1.25rem;">
                    <div class="admin-alert admin-alert-info">
                        <span class="admin-alert-icon"><i class="fa fa-info"></i></span>
                        <div class="admin-alert-content">
                            <div class="admin-alert-message">{{ session('status') }}</div>
                        </div>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="admin-alerts" style="margin-bottom:1.25rem;">
                    <div class="admin-alert admin-alert-error">
                        <span class="admin-alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                        <div class="admin-alert-content">
                            <div class="admin-alert-title">Login failed</div>
                            <div class="admin-alert-message">
                                @foreach($errors->all() as $error)
                                {{ $error }}@if(!$loop->last)<br>@endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="admin-form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" class="admin-form-control"
                               value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="admin@example.com">
                    </div>

                    <div class="admin-form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="admin-form-control"
                               required autocomplete="current-password" placeholder="••••••••">
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-check">
                            <input type="checkbox" name="remember" id="remember_me">
                            <span>Remember me for 30 days</span>
                        </label>
                    </div>

                    <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;padding:0.75rem;">
                        <i class="fa fa-sign-in"></i> Sign in to Admin
                    </button>
                </form>

                <div class="admin-auth-footer">
                    <a href="{{ route('home') }}"><i class="fa fa-arrow-left"></i> Back to website</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-auth-layout>
