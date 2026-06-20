@extends('admin.layout')

@section('title', $slider->exists ? 'Edit Slider' : 'Add Slider')
@section('breadcrumb', $slider->exists ? 'Edit Slider' : 'Add Slider')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $slider->exists ? 'Edit Slider' : 'Add Slider' }}</h1>
        <p>{{ $slider->exists ? 'Update home page slider.' : 'Add a new home page slider.' }}</p>
    </div>
    <a href="{{ route('admin.sliders.index') }}" class="admin-btn admin-btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ $slider->exists ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}" enctype="multipart/form-data">
            @csrf
            @if($slider->exists) @method('PUT') @endif

            <div class="admin-form-group"><label>Title</label><input class="admin-form-control" name="title" value="{{ old('title', $slider->title) }}"></div>
            <div class="admin-form-group"><label>Subtitle</label><input class="admin-form-control" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}"></div>
            <div class="admin-form-group">
                <label>Description</label>
                <textarea class="admin-form-control richtext-editor richtext-simple" name="description" data-richtext-height="140" placeholder="Slider description...">{{ old('description', $slider->description) }}</textarea>
            </div>
            @include('admin.partials.image-upload', [
                'name' => 'image',
                'label' => 'Image',
                'current' => $slider->image,
                'required' => ! $slider->exists,
                'optionalHint' => $slider->exists ? '(leave empty to keep current)' : null,
                'sizeTip' => 'Recommended: 1920×900px JPG or PNG for full-width home slider.',
                'fallback' => 'images/main-slider/slider1/slide1.jpg',
            ])
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="admin-form-group"><label>Button Text</label><input class="admin-form-control" name="button_text" value="{{ old('button_text', $slider->button_text) }}"></div>
                <div class="admin-form-group"><label>Button Link</label><input class="admin-form-control" name="button_link" value="{{ old('button_link', $slider->button_link) }}"></div>
            </div>
            <div class="admin-form-group"><label>Sort Order</label><input type="number" class="admin-form-control" name="sort_order" value="{{ old('sort_order', $slider->sort_order ?? 0) }}"></div>
            <div class="admin-form-group">
                <label class="admin-form-check"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}> Active</label>
            </div>
            <button type="submit" class="admin-btn admin-btn-primary"><i class="fa fa-save"></i> Save Slider</button>
        </form>
    </div>
</div>
@endsection
