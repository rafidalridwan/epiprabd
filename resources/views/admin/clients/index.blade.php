@extends('admin.layout')

@section('title', 'Clients')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Client Logos</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add Client</a>
</div>
<div class="card">
    <table>
        <thead><tr><th>Name</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @forelse($clients as $client)
            <tr>
                <td>{{ $client->name ?? '—' }}</td>
                <td>{{ $client->sort_order }}</td>
                <td>{{ $client->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">No client logos yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
