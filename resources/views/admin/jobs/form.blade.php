@extends('admin.layout')

@section('title', $job->exists ? 'Edit Job Circular' : 'Add Job Circular')
@section('breadcrumb', $job->exists ? 'Edit Job' : 'Add Job')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>{{ $job->exists ? 'Edit Job Circular' : 'Add Job Circular' }}</h1>
        <p>{{ $job->exists ? 'Update job details and description.' : 'Create a new job posting for the home page.' }}</p>
    </div>
    <a href="{{ route('admin.jobs.index') }}" class="admin-btn admin-btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form method="POST" action="{{ $job->exists ? route('admin.jobs.update', $job) : route('admin.jobs.store') }}">
            @csrf
            @if($job->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label>Job Title *</label>
                <input class="admin-form-control" name="title" value="{{ old('title', $job->title) }}" required placeholder="e.g. Senior Architect">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="admin-form-group">
                    <label>Department</label>
                    <input class="admin-form-control" name="department" value="{{ old('department', $job->department) }}" placeholder="e.g. Design">
                </div>
                <div class="admin-form-group">
                    <label>Job Type</label>
                    <input class="admin-form-control" name="job_type" value="{{ old('job_type', $job->job_type) }}" placeholder="e.g. Full-time">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;">
                <div class="admin-form-group">
                    <label>Location</label>
                    <input class="admin-form-control" name="location" value="{{ old('location', $job->location) }}" placeholder="e.g. New York, USA">
                </div>
                <div class="admin-form-group">
                    <label>Vacancies</label>
                    <input type="number" class="admin-form-control" name="vacancies" value="{{ old('vacancies', $job->vacancies) }}" min="1">
                </div>
                <div class="admin-form-group">
                    <label>Application Deadline</label>
                    <input type="date" class="admin-form-control" name="deadline" value="{{ old('deadline', $job->deadline?->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Excerpt</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Short summary shown on the home page card.</p>
                <textarea class="admin-form-control richtext-editor richtext-simple" name="excerpt" data-richtext-height="100" placeholder="Brief job summary...">{{ old('excerpt', $job->excerpt) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label>Full Description</label>
                <p class="admin-form-hint" style="margin-top:0;margin-bottom:0.5rem;">Detailed job requirements shown on the detail page.</p>
                <textarea class="admin-form-control richtext-editor" name="description" data-richtext-height="320" placeholder="Job responsibilities, requirements, benefits...">{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label>Sort Order</label>
                <input type="number" class="admin-form-control" name="sort_order" value="{{ old('sort_order', $job->sort_order ?? 0) }}">
            </div>

            <div class="admin-form-group" style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                <label class="admin-form-check">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $job->is_published ?? true) ? 'checked' : '' }}> Published
                </label>
                <label class="admin-form-check">
                    <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $job->show_on_home ?? true) ? 'checked' : '' }}> Show on Home Page
                </label>
            </div>

            <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fa fa-save"></i> Save Job Circular</button>
                <a href="{{ route('admin.jobs.index') }}" class="admin-btn admin-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
