@extends('admin.layout')

@section('title', 'Job Applications')
@section('breadcrumb', 'Job Applications')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Job Applications</h1>
        <p>Applications submitted through job circular pages.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                <tr>
                    <td><strong>{{ $application->name }}</strong></td>
                    <td>{{ $application->jobCircular?->title ?? '—' }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->phone ?? '—' }}</td>
                    <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if($application->is_read)
                        <span class="admin-badge admin-badge-muted">Read</span>
                        @else
                        <span class="admin-badge admin-badge-danger">New</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'viewUrl' => route('admin.applications.show', $application),
                            'viewTitle' => 'View',
                            'deleteUrl' => route('admin.applications.destroy', $application),
                            'deleteConfirm' => 'Delete this application?',
                        ])
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="admin-empty">
                            <i class="fa fa-file-text-o"></i>
                            <p>No applications yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($applications->hasPages())
    <div class="admin-pagination">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
