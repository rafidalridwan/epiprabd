@extends('admin.layout')

@section('title', $category->exists ? 'Edit Category' : 'Add Category')

@section('content')
<h1>{{ $category->exists ? 'Edit Category' : 'Add Category' }}</h1>
<div class="card">
    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="form-group"><label>Name</label><input class="form-control" name="name" value="{{ old('name', $category->name) }}" required></div>
        <div class="form-group"><label>Sort Order</label><input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}"></div>
        <div class="form-group"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}> Active</label></div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
