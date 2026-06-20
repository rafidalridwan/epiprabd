@extends('admin.layout')

@section('title', 'Testimonials')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
</div>
<div class="card">
    <table>
        <thead><tr><th style="width:80px;">Photo</th><th>Name</th><th>Position</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @forelse($testimonials as $testimonial)
            <tr>
                <td>@include('admin.partials.image-thumb', ['path' => $testimonial->image, 'alt' => $testimonial->name, 'fallback' => 'images/testimonials/pic1.jpg', 'size' => 'sm'])</td>
                <td>{{ $testimonial->name }}</td>
                <td>{{ $testimonial->position }}</td>
                <td>{{ $testimonial->sort_order }}</td>
                <td>{{ $testimonial->is_active ? 'Yes' : 'No' }}</td>
                <td class="admin-actions">
                    @include('admin.partials.table-actions', [
                        'editUrl' => route('admin.testimonials.edit', $testimonial),
                        'deleteUrl' => route('admin.testimonials.destroy', $testimonial),
                    ])
                </td>
            </tr>
            @empty
            <tr><td colspan="6">No testimonials yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
