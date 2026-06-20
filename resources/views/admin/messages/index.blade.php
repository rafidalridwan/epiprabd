@extends('admin.layout')

@section('title', 'Messages')
@section('breadcrumb', 'Messages')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Contact Messages</h1>
        <p>Messages submitted through the website contact form.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr>
                    <td><strong>{{ $message->name }}</strong></td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if($message->is_read)
                        <span class="admin-badge admin-badge-muted">Read</span>
                        @else
                        <span class="admin-badge admin-badge-danger">New</span>
                        @endif
                    </td>
                    <td>
                        <div class="admin-btn-group">
                            <a href="{{ route('admin.messages.show', $message) }}" class="admin-btn admin-btn-sm admin-btn-primary"><i class="fa fa-eye"></i> View</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
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
                            <i class="fa fa-inbox"></i>
                            <p>No messages yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="admin-pagination">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
