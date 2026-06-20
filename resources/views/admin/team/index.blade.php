@extends('admin.layout')

@section('title', 'Team')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Team Members</h1>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add Member</a>
</div>
<div class="card">
    <table>
        <thead><tr><th style="width:80px;">Photo</th><th>Name</th><th>Position</th><th>Featured</th><th></th></tr></thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>@include('admin.partials.image-thumb', ['path' => $member->image, 'alt' => $member->name, 'fallback' => 'images/our-team5/pic1.jpg'])</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->is_featured ? 'Yes' : 'No' }}</td>
                <td class="admin-actions">
                    @include('admin.partials.table-actions', [
                        'editUrl' => route('admin.team.edit', $member),
                        'deleteUrl' => route('admin.team.destroy', $member),
                    ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
