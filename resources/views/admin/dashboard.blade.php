@extends('admin.layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Welcome back, {{ auth()->user()->name }}!</h1>
        <p>Here's what's happening with your website today.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="admin-btn admin-btn-primary">
        <i class="fa fa-external-link"></i> View Website
    </a>
</div>

<div class="admin-stats">
    <div class="admin-stat-card">
        <div class="admin-stat-icon indigo"><i class="fa fa-briefcase"></i></div>
        <div>
            <div class="admin-stat-value">{{ $projectCount }}</div>
            <div class="admin-stat-label">Total Projects</div>
            <a href="{{ route('admin.projects.index') }}" class="admin-stat-link">Manage projects →</a>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon blue"><i class="fa fa-picture-o"></i></div>
        <div>
            <div class="admin-stat-value">{{ $sliderCount }}</div>
            <div class="admin-stat-label">Home Sliders</div>
            <a href="{{ route('admin.sliders.index') }}" class="admin-stat-link">Manage sliders →</a>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon green"><i class="fa fa-users"></i></div>
        <div>
            <div class="admin-stat-value">{{ $teamCount }}</div>
            <div class="admin-stat-label">Team Members</div>
            <a href="{{ route('admin.team.index') }}" class="admin-stat-link">Manage team →</a>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon {{ $unreadMessages > 0 ? 'rose' : 'amber' }}"><i class="fa fa-envelope"></i></div>
        <div>
            <div class="admin-stat-value">{{ $unreadMessages }}</div>
            <div class="admin-stat-label">Unread Messages</div>
            <a href="{{ route('admin.messages.index') }}" class="admin-stat-link">View inbox →</a>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2><i class="fa fa-bolt" style="color:var(--admin-primary);margin-right:0.5rem;"></i> Quick Actions</h2>
        </div>
        <div class="admin-card-body">
            <div class="admin-quick-actions">
                <a href="{{ route('admin.projects.create') }}" class="admin-quick-action">
                    <i class="fa fa-plus-circle"></i>
                    <span>Add Project</span>
                </a>
                <a href="{{ route('admin.sliders.create') }}" class="admin-quick-action">
                    <i class="fa fa-picture-o"></i>
                    <span>Add Slider</span>
                </a>
                <a href="{{ route('admin.team.create') }}" class="admin-quick-action">
                    <i class="fa fa-user-plus"></i>
                    <span>Add Team Member</span>
                </a>
                <a href="{{ route('admin.pages.index') }}" class="admin-quick-action">
                    <i class="fa fa-edit"></i>
                    <span>Edit Pages</span>
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="admin-quick-action">
                    <i class="fa fa-cog"></i>
                    <span>Site Settings</span>
                </a>
                <a href="{{ route('admin.messages.index') }}" class="admin-quick-action">
                    <i class="fa fa-envelope"></i>
                    <span>Messages</span>
                </a>
                <a href="{{ route('admin.jobs.create') }}" class="admin-quick-action">
                    <i class="fa fa-id-card-o"></i>
                    <span>Add Job Circular</span>
                </a>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h2><i class="fa fa-envelope" style="color:var(--admin-primary);margin-right:0.5rem;"></i> Recent Messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="admin-btn admin-btn-sm admin-btn-secondary">View All</a>
        </div>
        <div class="admin-table-wrap">
            @if($recentMessages->count())
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMessages as $msg)
                    <tr>
                        <td>
                            <strong>{{ $msg->name }}</strong>
                            @if(!$msg->is_read)
                            <span class="admin-badge admin-badge-danger" style="margin-left:0.35rem;">New</span>
                            @endif
                        </td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ $msg->created_at->format('M d, Y') }}</td>
                        <td class="admin-actions">
                            @include('admin.partials.table-actions', [
                                'viewUrl' => route('admin.messages.show', $msg),
                                'viewTitle' => 'View',
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="admin-empty">
                <i class="fa fa-inbox"></i>
                <p>No messages yet. They will appear here when visitors submit the contact form.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media (max-width: 900px) {
    .admin-content > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush
