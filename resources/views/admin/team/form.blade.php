@extends('admin.layout')

@section('title', $member->exists ? 'Edit Team Member' : 'Add Team Member')

@section('content')
<h1>{{ $member->exists ? 'Edit Team Member' : 'Add Team Member' }}</h1>
<div class="card">
    <form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        @if($member->exists) @method('PUT') @endif
        <div class="form-group"><label>Name</label><input class="form-control" name="name" value="{{ old('name', $member->name) }}" required></div>
        <div class="form-group"><label>Position</label><input class="form-control" name="position" value="{{ old('position', $member->position) }}"></div>
        <div class="form-group"><label>Photo</label><input type="file" class="form-control" name="image" accept="image/*">@if($member->image)<p>Current: {{ $member->image }}</p>@endif</div>
        <div class="form-group"><label>Facebook</label><input class="form-control" name="facebook" value="{{ old('facebook', $member->facebook) }}"></div>
        <div class="form-group"><label>Twitter</label><input class="form-control" name="twitter" value="{{ old('twitter', $member->twitter) }}"></div>
        <div class="form-group"><label>LinkedIn</label><input class="form-control" name="linkedin" value="{{ old('linkedin', $member->linkedin) }}"></div>
        <div class="form-group"><label>Sort Order</label><input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}"></div>
        <div class="form-group"><label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $member->is_featured) ? 'checked' : '' }}> Featured (large display)</label></div>
        <div class="form-group"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}> Active</label></div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
