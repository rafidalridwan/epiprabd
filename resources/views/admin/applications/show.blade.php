@extends('admin.layout')

@section('title', 'Application')
@section('breadcrumb', 'Application')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Application from {{ $application->name }}</h1>
        <p>Received {{ $application->created_at->format('F d, Y \a\t H:i') }}</p>
    </div>
    <a href="{{ route('admin.applications.index') }}" class="admin-btn admin-btn-secondary">
        <i class="fa fa-arrow-left"></i> Back to Applications
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin-bottom:1.5rem;">
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Applicant</div>
                <div style="font-weight:600;">{{ $application->name }}</div>
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Email</div>
                <a href="mailto:{{ $application->email }}">{{ $application->email }}</a>
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Phone</div>
                @if($application->phone)
                <a href="tel:{{ $application->phone }}">{{ $application->phone }}</a>
                @else
                —
                @endif
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Position</div>
                <div style="font-weight:600;">
                    @if($application->jobCircular)
                    <a href="{{ route('jobs.show', $application->jobCircular->slug) }}" target="_blank">{{ $application->jobCircular->title }}</a>
                    @else
                    —
                    @endif
                </div>
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">CV</div>
                <a href="{{ route('admin.applications.download', $application) }}" class="admin-btn admin-btn-sm admin-btn-primary">
                    <i class="fa fa-download"></i> {{ $application->cv_original_name ?? 'Download CV' }}
                </a>
            </div>
        </div>

        @if($application->message)
        <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.5rem;">Cover Letter / Message</div>
        <div style="background:#f8fafc;border:1px solid var(--admin-border);border-radius:8px;padding:1.25rem;line-height:1.7;margin-bottom:1.5rem;">
            {{ $application->message }}
        </div>
        @endif

        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            <a href="mailto:{{ $application->email }}" class="admin-btn admin-btn-primary"><i class="fa fa-reply"></i> Reply via Email</a>
            <a href="{{ route('admin.applications.download', $application) }}" class="admin-btn admin-btn-secondary"><i class="fa fa-download"></i> Download CV</a>
            <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" onsubmit="return confirm('Delete this application?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
