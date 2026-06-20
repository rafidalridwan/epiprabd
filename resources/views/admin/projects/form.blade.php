@extends('admin.layout')

@section('title', $project->exists ? 'Edit Project' : 'Add Project')
@section('breadcrumb', $project->exists ? 'Edit Project' : 'Add Project')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $project->exists ? 'Edit Project' : 'Add Project' }}</h1>
        <p>{{ $project->exists ? 'Update project details and images.' : 'Create a new portfolio project.' }}</p>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf
            @if($project->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label>Title *</label>
                <input class="admin-form-control" name="title" value="{{ old('title', $project->title) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Category</label>
                <select class="admin-form-control" name="project_category_id">
                    <option value="">— Select —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('project_category_id', $project->project_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label>Excerpt</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Short summary shown on the projects grid.</p>
                <textarea class="admin-form-control richtext-editor richtext-simple" name="excerpt" data-richtext-height="120" placeholder="Brief project summary...">{{ old('excerpt', $project->excerpt) }}</textarea>
            </div>
            <div class="admin-form-group">
                <label>Description</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Full project description shown on the detail page.</p>
                <textarea class="admin-form-control richtext-editor" name="description" data-richtext-height="320" placeholder="Write project description...">{{ old('description', $project->description) }}</textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                @include('admin.partials.image-upload', [
                    'name' => 'image',
                    'label' => 'Image',
                    'current' => $project->image,
                    'sizeTip' => 'Recommended: 570×700px portrait JPG or PNG for project grid cards.',
                    'fallback' => 'images/gallery/portrait/pic1.jpg',
                ])
                @include('admin.partials.image-upload', [
                    'name' => 'banner_image',
                    'label' => 'Banner Image',
                    'current' => $project->banner_image,
                    'sizeTip' => 'Recommended: 1920×600px JPG or PNG for project detail banner.',
                    'fallback' => 'images/background/bg-11.jpg',
                ])
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="admin-form-group">
                    <label>Project Date</label>
                    <input type="date" class="admin-form-control" name="project_date" value="{{ old('project_date', $project->project_date?->format('Y-m-d')) }}">
                </div>
                <div class="admin-form-group">
                    <label>Sort Order</label>
                    <input type="number" class="admin-form-control" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}">
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;">
                <div class="admin-form-group"><label>Client</label><input class="admin-form-control" name="client" value="{{ old('client', $project->client) }}"></div>
                <div class="admin-form-group"><label>Project Type</label><input class="admin-form-control" name="project_type" value="{{ old('project_type', $project->project_type) }}"></div>
                <div class="admin-form-group"><label>Creative Director</label><input class="admin-form-control" name="creative_director" value="{{ old('creative_director', $project->creative_director) }}"></div>
            </div>
            <div class="admin-form-group" style="display:flex;gap:1.5rem;">
                <label class="admin-form-check"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }}> Published</label>
                <label class="admin-form-check"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}> Featured on Home</label>
            </div>
            <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fa fa-save"></i> Save Project</button>
                <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
