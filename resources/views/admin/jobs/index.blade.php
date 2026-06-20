@extends('admin.layout')

@section('title', 'Job Circulars')
@section('breadcrumb', 'Job Circulars')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Job Circulars</h1>
        <p>Manage career opportunities shown on the home page.</p>
    </div>
    <a href="{{ route('admin.jobs.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa fa-plus"></i> Add Job Circular
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Deadline</th>
                    <th>Home</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td><strong>{{ $job->title }}</strong></td>
                    <td>{{ $job->department ?? '—' }}</td>
                    <td>{{ $job->deadline?->format('M d, Y') ?? '—' }}</td>
                    <td>
                        @if($job->show_on_home)
                        <span class="admin-badge admin-badge-info">Yes</span>
                        @else
                        <span class="admin-badge admin-badge-muted">No</span>
                        @endif
                    </td>
                    <td>
                        @if($job->is_published)
                        <span class="admin-badge admin-badge-success">Published</span>
                        @else
                        <span class="admin-badge admin-badge-warning">Draft</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'viewUrl' => route('jobs.show', $job->slug),
                            'viewTarget' => '_blank',
                            'editUrl' => route('admin.jobs.edit', $job),
                            'deleteUrl' => route('admin.jobs.destroy', $job),
                            'deleteConfirm' => 'Delete this job circular?',
                        ])
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="admin-empty">
                            <i class="fa fa-briefcase"></i>
                            <p>No job circulars yet. <a href="{{ route('admin.jobs.create') }}">Add your first job</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
