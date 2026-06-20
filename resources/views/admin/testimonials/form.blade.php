@extends('admin.layout')

@section('title', $testimonial->exists ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
<h1>{{ $testimonial->exists ? 'Edit Testimonial' : 'Add Testimonial' }}</h1>
<div class="card">
    <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @if($testimonial->exists) @method('PUT') @endif
        <div class="form-group"><label>Name</label><input class="form-control" name="name" value="{{ old('name', $testimonial->name) }}" required></div>
        <div class="form-group"><label>Position</label><input class="form-control" name="position" value="{{ old('position', $testimonial->position) }}"></div>
        <div class="form-group"><label>Quote</label><textarea class="form-control" name="quote" rows="4" required>{{ old('quote', $testimonial->quote) }}</textarea></div>
        <div class="form-group">
            <label>Photo {{ $testimonial->exists ? '(leave empty to keep current)' : '' }}</label>
            <input type="file" class="form-control" name="image" accept="image/*" {{ $testimonial->exists ? '' : 'required' }}>
            @if($testimonial->image)<p>Current: {{ $testimonial->image }}</p>@endif
        </div>
        <div class="form-group"><label>Sort Order</label><input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}"></div>
        <div class="form-group"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}> Active</label></div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
