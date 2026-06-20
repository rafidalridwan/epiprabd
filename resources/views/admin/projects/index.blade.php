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
                    <td>
                        <div class="admin-btn-group">
                            <a href="{{ route('projects.show', $project->slug) }}" class="admin-btn admin-btn-sm admin-btn-secondary" target="_blank"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="admin-btn admin-btn-sm admin-btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
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
