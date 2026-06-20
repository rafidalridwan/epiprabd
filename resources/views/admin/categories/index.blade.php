@extends('admin.layout')

@section('title', 'Categories')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Project Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
</div>
<div class="card">
    <table>
        <thead><tr><th>Name</th><th>Slug</th><th>Order</th><th>Active</th><th></th></tr></thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->sort_order }}</td>
                <td>{{ $category->is_active ? 'Yes' : 'No' }}</td>
                <td class="admin-actions">
                    @include('admin.partials.table-actions', [
                        'editUrl' => route('admin.categories.edit', $category),
                        'deleteUrl' => route('admin.categories.destroy', $category),
                    ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
