@extends('admin.layout')

@section('title', 'Edit Page')
@section('breadcrumb', 'Edit ' . $page->title)

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Edit: {{ $page->title }}</h1>
        <p>Update page content, banner, and SEO settings.</p>
    </div>
    <a href="{{ route('admin.pages.index') }}" class="admin-btn admin-btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="admin-form-group"><label>Title</label><input class="admin-form-control" name="title" value="{{ old('title', $page->title) }}" required></div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="admin-form-group"><label>Meta Title</label><input class="admin-form-control" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"></div>
                <div class="admin-form-group"><label>Subtitle</label><input class="admin-form-control" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"></div>
            </div>
            <div class="admin-form-group"><label>Meta Description</label><textarea class="admin-form-control" name="meta_description" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea></div>
            <div class="admin-form-group"><label>Banner Title</label><input class="admin-form-control" name="banner_title" value="{{ old('banner_title', $page->banner_title) }}"></div>
            @include('admin.partials.image-upload', [
                'name' => 'banner_image',
                'label' => 'Banner Image',
                'current' => $page->banner_image,
                'sizeTip' => 'Recommended: 1920×600px JPG or PNG for full-width page banners.',
                'fallback' => 'images/background/bg-11.jpg',
            ])
            <div class="admin-form-group"><label>Heading</label><input class="admin-form-control" name="heading" value="{{ old('heading', $page->heading) }}"></div>
            <div class="admin-form-group">
                <label>Content</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Use the editor below to format text. Images are managed separately via banner upload.</p>
                <textarea class="admin-form-control richtext-editor" name="content" rows="8" placeholder="Write page content...">{{ old('content', $page->content) }}</textarea>
            </div>

            @if($page->slug === 'home')
            <div class="admin-form-section">
                <h3><i class="fa fa-home" style="color:var(--admin-primary);"></i> Welcome Section</h3>
                @include('admin.partials.image-upload', [
                    'name' => 'intro_image',
                    'label' => 'Intro Image',
                    'current' => $page->intro_image,
                    'sizeTip' => 'Recommended: 570×700px portrait JPG or PNG for the home welcome section.',
                    'fallback' => 'images/gallery/portrait/pic2.jpg',
                ])
            </div>

            <div class="admin-form-section">
                <h3><i class="fa fa-users" style="color:var(--admin-primary);"></i> Who We Are Section</h3>
                <div class="admin-form-group"><label>Subtitle</label><input class="admin-form-control" name="who_subtitle" value="{{ old('who_subtitle', $page->who_subtitle) }}"></div>
                <div class="admin-form-group"><label>Heading</label><input class="admin-form-control" name="who_heading" value="{{ old('who_heading', $page->who_heading) }}"></div>
                <div class="admin-form-group"><label>Content</label><textarea class="admin-form-control" name="who_content" rows="4">{{ old('who_content', $page->who_content) }}</textarea></div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="admin-form-group"><label>Badge Strong Text</label><input class="admin-form-control" name="who_badge_strong" value="{{ old('who_badge_strong', $page->who_badge_strong) }}" placeholder="30+ Projects"></div>
                    <div class="admin-form-group"><label>Badge Span Text</label><input class="admin-form-control" name="who_badge_span" value="{{ old('who_badge_span', $page->who_badge_span) }}" placeholder="Completed"></div>
                </div>
                <p class="admin-form-hint">The carousel in this section uses published projects automatically.</p>
            </div>

            <div class="admin-form-section">
                <h3><i class="fa fa-bar-chart" style="color:var(--admin-primary);"></i> Facts / Counters Section</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="admin-form-group"><label>Subtitle</label><input class="admin-form-control" name="facts_subtitle" value="{{ old('facts_subtitle', $page->facts_subtitle) }}"></div>
                    <div class="admin-form-group"><label>Heading</label><input class="admin-form-control" name="facts_heading" value="{{ old('facts_heading', $page->facts_heading) }}"></div>
                </div>
                <div class="admin-form-group"><label>Content</label><textarea class="admin-form-control" name="facts_content" rows="3">{{ old('facts_content', $page->facts_content) }}</textarea></div>
                <div class="admin-form-group">
                    <label>Background Image Path</label>
                    @if($page->facts_bg_image)
                    <div class="admin-image-preview-box admin-image-preview-static">
                        <span class="admin-image-preview-label">Current background</span>
                        <div class="admin-image-preview-frame">
                            <img src="{{ media_url($page->facts_bg_image, 'images/background/bg-11.jpg') }}" alt="Facts background">
                        </div>
                    </div>
                    @endif
                    <input class="admin-form-control" name="facts_bg_image" value="{{ old('facts_bg_image', $page->facts_bg_image) }}" placeholder="images/background/bg-11.jpg">
                    <p class="admin-form-hint"><i class="fa fa-info-circle"></i> Recommended: 1920×900px JPG or PNG. Use a path under public/ or upload via storage.</p>
                </div>
                @php $stats = old('stat_value') ? collect(old('stat_value'))->map(fn($v, $i) => ['value' => $v, 'label' => old('stat_label.'.$i)]) : collect($page->facts_stats ?? []); @endphp
                @foreach(range(0, 2) as $i)
                <div style="display:grid;grid-template-columns:120px 1fr;gap:1rem;margin-bottom:0.75rem;">
                    <div class="admin-form-group" style="margin:0;"><label>Counter {{ $i + 1 }} Value</label><input class="admin-form-control" name="stat_value[]" value="{{ $stats[$i]['value'] ?? '' }}"></div>
                    <div class="admin-form-group" style="margin:0;"><label>Counter {{ $i + 1 }} Label</label><input class="admin-form-control" name="stat_label[]" value="{{ $stats[$i]['label'] ?? '' }}"></div>
                </div>
                @endforeach
            </div>
            @endif

            <div class="admin-form-group">
                <label class="admin-form-check"><input type="checkbox" name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }}> Published</label>
            </div>
            <button type="submit" class="admin-btn admin-btn-primary"><i class="fa fa-save"></i> Update Page</button>
        </form>
    </div>
</div>
@endsection
