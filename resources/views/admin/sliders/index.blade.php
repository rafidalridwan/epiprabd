@extends('admin.layout')

@section('title', 'Sliders')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Home Sliders</h1>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add Slider</a>
</div>
<div class="card">
    <table>
        <thead><tr><th>Title</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->sort_order }}</td>
                <td>{{ $slider->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.sliders.destroy', $slider) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
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
