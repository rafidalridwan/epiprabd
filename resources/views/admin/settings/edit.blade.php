@extends('admin.layout')

@section('title', 'Site Settings')
@section('breadcrumb', 'Settings')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Site Settings</h1>
        <p>Configure your website contact info, branding, SEO, and social links.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <h3 style="margin:0 0 1rem;font-size:1rem;"><i class="fa fa-info-circle" style="color:var(--admin-primary);"></i> General</h3>
            <div class="admin-form-group">
                <label>Site Name</label>
                <input class="admin-form-control" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
            </div>
            @include('admin.partials.image-upload', [
                'name' => 'logo',
                'label' => 'Logo',
                'current' => $settings['logo'] ?? null,
                'sizeTip' => 'Recommended: 340×98px PNG or SVG with transparent background.',
                'fallback' => 'images/logo-dark.png',
            ])

            <div class="admin-form-section">
                <h3><i class="fa fa-phone" style="color:var(--admin-primary);"></i> Contact Information</h3>
                <div class="admin-form-group">
                    <label>Email</label>
                    <input class="admin-form-control" name="site_email" value="{{ $settings['site_email'] ?? '' }}">
                </div>
                <div class="admin-form-group">
                    <label>Phone</label>
                    <input class="admin-form-control" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}">
                </div>
                <div class="admin-form-group">
                    <label>Address</label>
                    <textarea class="admin-form-control" name="site_address" rows="2">{{ $settings['site_address'] ?? '' }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label>Footer Text</label>
                    <input class="admin-form-control" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}">
                </div>
                <div class="admin-form-group">
                    <label>Google Map Embed URL</label>
                    <input class="admin-form-control" name="map_embed" value="{{ $settings['map_embed'] ?? '' }}">
                    <p class="admin-form-hint">Paste the iframe src URL from Google Maps embed.</p>
                </div>
            </div>

            <div class="admin-form-section">
                <h3><i class="fa fa-search" style="color:var(--admin-primary);"></i> SEO &amp; Open Graph</h3>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:1rem;">Used on public website pages only (search engines and social sharing).</p>
                <div class="admin-form-group">
                    <label>Meta Keywords</label>
                    <textarea class="admin-form-control" name="meta_keywords" rows="2" placeholder="architecture, interior design, construction">{{ $settings['meta_keywords'] ?? '' }}</textarea>
                    <p class="admin-form-hint">Comma-separated keywords for search engines.</p>
                </div>
                <div class="admin-form-group">
                    <label>OG Title</label>
                    <input class="admin-form-control" name="og_title" value="{{ $settings['og_title'] ?? '' }}" placeholder="Defaults to page or site title">
                </div>
                <div class="admin-form-group">
                    <label>OG Description</label>
                    <textarea class="admin-form-control" name="og_description" rows="2" placeholder="Short description for social sharing">{{ $settings['og_description'] ?? '' }}</textarea>
                    <p class="admin-form-hint">Also used as the default meta description when a page has none set.</p>
                </div>
                @include('admin.partials.image-upload', [
                    'name' => 'og_image',
                    'label' => 'OG Image',
                    'current' => $settings['og_image'] ?? null,
                    'sizeTip' => 'Recommended: 1200×630px JPG or PNG (1.91:1 ratio for Facebook, LinkedIn, etc.). Falls back to logo if empty.',
                    'fallback' => 'images/logo-dark.png',
                ])
            </div>

            <div class="admin-form-section">
                <h3><i class="fa fa-share-alt" style="color:var(--admin-primary);"></i> Social Links</h3>
                <div class="admin-form-group"><label>Facebook</label><input class="admin-form-control" name="facebook" value="{{ $settings['facebook'] ?? '' }}"></div>
                <div class="admin-form-group"><label>Twitter</label><input class="admin-form-control" name="twitter" value="{{ $settings['twitter'] ?? '' }}"></div>
                <div class="admin-form-group"><label>LinkedIn</label><input class="admin-form-control" name="linkedin" value="{{ $settings['linkedin'] ?? '' }}"></div>
                <div class="admin-form-group"><label>Instagram</label><input class="admin-form-control" name="instagram" value="{{ $settings['instagram'] ?? '' }}"></div>
                <div class="admin-form-group"><label>YouTube</label><input class="admin-form-control" name="youtube" value="{{ $settings['youtube'] ?? '' }}"></div>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fa fa-save"></i> Save Settings
            </button>
        </form>
    </div>
</div>
@endsection
