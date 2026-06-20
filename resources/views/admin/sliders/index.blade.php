@extends('admin.layout')

@section('title', 'Sliders')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Home Sliders</h1>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add Slider</a>
</div>
<div class="card">
    <table>
        <thead><tr><th style="width:80px;">Image</th><th>Title</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td>@include('admin.partials.image-thumb', ['path' => $slider->image, 'alt' => $slider->title, 'fallback' => 'images/main-slider/slider1/slide1.jpg', 'size' => 'lg'])</td>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->sort_order }}</td>
                <td>{{ $slider->is_active ? 'Yes' : 'No' }}</td>
                <td class="admin-actions">
                    @include('admin.partials.table-actions', [
                        'editUrl' => route('admin.sliders.edit', $slider),
                        'deleteUrl' => route('admin.sliders.destroy', $slider),
                    ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
