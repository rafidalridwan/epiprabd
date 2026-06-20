@extends('admin.layout')

@section('title', $client->exists ? 'Edit Client' : 'Add Client')

@section('content')
<h1>{{ $client->exists ? 'Edit Client' : 'Add Client' }}</h1>
<div class="card">
    <form method="POST" action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}" enctype="multipart/form-data">
        @csrf
        @if($client->exists) @method('PUT') @endif
        <div class="form-group"><label>Name (optional)</label><input class="form-control" name="name" value="{{ old('name', $client->name) }}"></div>
        <div class="form-group"><label>Website URL (optional)</label><input class="form-control" name="url" value="{{ old('url', $client->url) }}"></div>
        <div class="form-group">
            <label>Logo {{ $client->exists ? '(leave empty to keep current)' : '' }}</label>
            <input type="file" class="form-control" name="logo" accept="image/*" {{ $client->exists ? '' : 'required' }}>
            @if($client->logo)<p>Current: {{ $client->logo }}</p>@endif
        </div>
        <div class="form-group"><label>Sort Order</label><input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $client->sort_order ?? 0) }}"></div>
        <div class="form-group"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}> Active</label></div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
