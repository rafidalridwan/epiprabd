@extends('admin.layout')

@section('title', 'Testimonials')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
</div>
<div class="card">
    <table>
        <thead><tr><th>Name</th><th>Position</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @forelse($testimonials as $testimonial)
            <tr>
                <td>{{ $testimonial->name }}</td>
                <td>{{ $testimonial->position }}</td>
                <td>{{ $testimonial->sort_order }}</td>
                <td>{{ $testimonial->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No testimonials yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
