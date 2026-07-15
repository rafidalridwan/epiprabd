@extends('admin.layout')

@section('title', $blog->exists ? 'Edit Blog Post' : 'Add Blog Post')
@section('breadcrumb', $blog->exists ? 'Edit Blog' : 'Add Blog')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $blog->exists ? 'Edit Blog Post' : 'Add Blog Post' }}</h1>
        <p>{{ $blog->exists ? 'Update this blog post.' : 'Create a new blog post for the website.' }}</p>
    </div>
    <a href="{{ route('admin.blogs.index') }}" class="admin-btn admin-btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ $blog->exists ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" enctype="multipart/form-data">
            @csrf
            @if($blog->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label>Title *</label>
                <input class="admin-form-control" name="title" value="{{ old('title', $blog->title) }}" required placeholder="e.g. Design Trends for Modern Homes">
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-group">
                <label>Excerpt</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Short summary shown on the blog list.</p>
                <textarea class="admin-form-control" name="excerpt" rows="3" placeholder="Brief summary...">{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-group">
                <label>Content</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Full blog post content.</p>
                <textarea class="admin-form-control richtext-editor" name="content" data-richtext-height="360" placeholder="Write your blog post...">{{ old('content', $blog->content) }}</textarea>
                @error('content')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            @include('admin.partials.image-upload', [
                'name' => 'image',
                'label' => 'Featured Image',
                'current' => $blog->image,
                'required' => false,
                'optionalHint' => $blog->exists ? '(leave empty to keep current)' : '(optional)',
                'sizeTip' => 'Recommended: 1200×800px JPG or PNG for blog cards and banner.',
                'fallback' => 'images/gallery/portrait/pic1.jpg',
            ])

            <div class="admin-form-group admin-multi-image-upload" data-multi-image-upload data-multi-image-no-video>
                <label>Gallery Images (Slider)</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.75rem;">Upload multiple images for the auto-playing slider on the blog detail page. If none are added, the featured image is used.</p>

                @if($blog->exists && $blog->images->count())
                <div class="admin-gallery-grid" data-gallery-existing>
                    @foreach($blog->images as $galleryImage)
                    <div class="admin-gallery-item">
                        <label class="admin-gallery-item-remove-label">
                            <input type="checkbox" name="remove_images[]" value="{{ $galleryImage->id }}">
                            <span class="admin-gallery-item-frame">
                                <img src="{{ media_url($galleryImage->image, 'images/gallery/portrait/pic1.jpg') }}" alt="Gallery image">
                            </span>
                            <span class="admin-gallery-item-remove">Remove</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="admin-gallery-grid" data-gallery-preview hidden></div>

                <div class="admin-file-input">
                    <input
                        type="file"
                        id="blog-gallery-images"
                        class="admin-file-input-native"
                        name="images[]"
                        accept="image/*"
                        multiple
                        data-multi-image-input
                    >
                    <label for="blog-gallery-images" class="admin-file-input-trigger">
                        <i class="fa fa-cloud-upload"></i>
                        <span>Choose images</span>
                    </label>
                    <span class="admin-file-input-name" data-multi-image-filename>No files chosen</span>
                </div>
                <p class="admin-form-hint"><i class="fa fa-info-circle"></i> Recommended: 1200×800px or larger JPG/PNG. You can select multiple files at once.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="admin-form-group">
                    <label>Published Date</label>
                    <input type="date" class="admin-form-control" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d')) }}">
                </div>
                <div class="admin-form-group">
                    <label>Sort Order</label>
                    <input type="number" class="admin-form-control" name="sort_order" value="{{ old('sort_order', $blog->sort_order ?? 0) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-check">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published ?? true) ? 'checked' : '' }}> Published
                </label>
            </div>

            <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fa fa-save"></i> Save Blog Post</button>
                <a href="{{ route('admin.blogs.index') }}" class="admin-btn admin-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
