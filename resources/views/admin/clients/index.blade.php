@extends('admin.layout')

@section('title', 'Clients')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Client Logos</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add Client</a>
</div>
<div class="card">
    <table>
        <thead><tr><th style="width:80px;">Logo</th><th>Name</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @forelse($clients as $client)
            <tr>
                <td>@include('admin.partials.image-thumb', ['path' => $client->logo, 'alt' => $client->name, 'fallback' => 'images/client-logo/w1.png', 'size' => 'lg'])</td>
                <td>{{ $client->name ?? '—' }}</td>
                <td>{{ $client->sort_order }}</td>
                <td>{{ $client->is_active ? 'Yes' : 'No' }}</td>
                <td class="admin-actions">
                    @include('admin.partials.table-actions', [
                        'editUrl' => route('admin.clients.edit', $client),
                        'deleteUrl' => route('admin.clients.destroy', $client),
                    ])
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No client logos yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
