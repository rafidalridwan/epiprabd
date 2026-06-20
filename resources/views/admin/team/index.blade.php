@extends('admin.layout')

@section('title', 'Team')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Team Members</h1>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add Member</a>
</div>
<div class="card">
    <table>
        <thead><tr><th>Name</th><th>Position</th><th>Featured</th><th></th></tr></thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->is_featured ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
