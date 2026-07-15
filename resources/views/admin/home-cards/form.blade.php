@extends('admin.layout')

@section('title', $card->exists ? 'Edit Home Card' : 'Add Home Card')
@section('breadcrumb', $card->exists ? 'Edit Home Card' : 'Add Home Card')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $card->exists ? 'Edit Home Card' : 'Add Home Card' }}</h1>
        <p>{{ $card->exists ? 'Update this service card and its popup details.' : 'Add a service card shown on the services page.' }}</p>
    </div>
    <a href="{{ route('admin.home-cards.index') }}" class="admin-btn admin-btn-secondary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ $card->exists ? route('admin.home-cards.update', $card) : route('admin.home-cards.store') }}" enctype="multipart/form-data">
            @csrf
            @if($card->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label for="title">Title</label>
                <input id="title" class="form-control" name="title" value="{{ old('title', $card->title) }}" required>
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-group">
                <label for="subtitle">Subtitle</label>
                <input id="subtitle" class="form-control" name="subtitle" value="{{ old('subtitle', $card->subtitle) }}" maxlength="500">
                @error('subtitle')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-group">
                <label for="details">Details</label>
                <textarea
                    id="details"
                    class="admin-form-control richtext-editor"
                    name="details"
                    data-richtext-height="280"
                    placeholder="Full service details shown in the popup..."
                >{{ old('details', $card->details) }}</textarea>
                <p class="admin-form-hint">Shown in the popup when a visitor clicks this service card.</p>
                @error('details')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            @include('admin.partials.image-upload', [
                'name' => 'image',
                'label' => 'Image',
                'current' => $card->image,
                'required' => ! $card->exists,
                'optionalHint' => $card->exists ? '(leave empty to keep current)' : null,
                'sizeTip' => 'Recommended: 800×600px JPG or PNG for home page cards.',
                'fallback' => 'images/gallery/portrait/pic1.jpg',
            ])

            <div class="admin-form-group">
                <label for="link">Link (optional)</label>
                <input id="link" class="form-control" name="link" value="{{ old('link', $card->link) }}" placeholder="/projects or https://...">
                @error('link')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-group">
                <label for="sort_order">Sort Order</label>
                <input id="sort_order" type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $card->sort_order ?? 0) }}">
            </div>

            <div class="admin-form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $card->is_active ?? true) ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fa fa-save"></i> Save Card
            </button>
        </form>
    </div>
</div>
@endsection
