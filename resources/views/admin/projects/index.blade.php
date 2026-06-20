@extends('admin.layout')

@section('title', 'Projects')
@section('breadcrumb', 'Projects')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Projects</h1>
        <p>Manage your portfolio projects shown on the website.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa fa-plus"></i> Add Project
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:80px;">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>@include('admin.partials.image-thumb', ['path' => $project->image, 'alt' => $project->title, 'fallback' => 'images/gallery/portrait/pic1.jpg'])</td>
                    <td><strong>{{ $project->title }}</strong></td>
                    <td>{{ $project->category?->name ?? '—' }}</td>
                    <td>
                        @if($project->is_featured)
                        <span class="admin-badge admin-badge-info">Featured</span>
                        @else
                        <span class="admin-badge admin-badge-muted">No</span>
                        @endif
                    </td>
                    <td>
                        @if($project->is_published)
                        <span class="admin-badge admin-badge-success">Published</span>
                        @else
                        <span class="admin-badge admin-badge-warning">Draft</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'viewUrl' => route('projects.show', $project->slug),
                            'viewTarget' => '_blank',
                            'editUrl' => route('admin.projects.edit', $project),
                            'deleteUrl' => route('admin.projects.destroy', $project),
                            'deleteConfirm' => 'Delete this project?',
                        ])
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="admin-empty">
                            <i class="fa fa-briefcase"></i>
                            <p>No projects yet. <a href="{{ route('admin.projects.create') }}">Add your first project</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
