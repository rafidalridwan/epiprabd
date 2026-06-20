@extends('admin.layout')

@section('title', 'Message')
@section('breadcrumb', 'Message')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Message from {{ $message->name }}</h1>
        <p>Received {{ $message->created_at->format('F d, Y \a\t H:i') }}</p>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="admin-btn admin-btn-secondary">
        <i class="fa fa-arrow-left"></i> Back to Inbox
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin-bottom:1.5rem;">
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">From</div>
                <div style="font-weight:600;">{{ $message->name }}</div>
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Email</div>
                <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
            </div>
            <div>
                <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.25rem;">Status</div>
                @if($message->is_read)
                <span class="admin-badge admin-badge-muted">Read</span>
                @else
                <span class="admin-badge admin-badge-success">Marked as read</span>
                @endif
            </div>
        </div>
        <div style="font-size:0.75rem;text-transform:uppercase;color:var(--admin-muted);font-weight:600;margin-bottom:0.5rem;">Message</div>
        <div style="background:#f8fafc;border:1px solid var(--admin-border);border-radius:8px;padding:1.25rem;line-height:1.7;">
            {{ $message->message }}
        </div>
        <div style="margin-top:1.5rem;display:flex;gap:0.5rem;">
            <a href="mailto:{{ $message->email }}" class="admin-btn admin-btn-primary"><i class="fa fa-reply"></i> Reply via Email</a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
