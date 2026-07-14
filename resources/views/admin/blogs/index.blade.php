@extends('admin.layout')

@section('title', 'Blogs')
@section('breadcrumb', 'Blogs')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Blogs</h1>
        <p>Manage blog posts shown on the website.</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa fa-plus"></i> Add Blog Post
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        @include('admin.partials.image-thumb', [
                            'path' => $blog->image,
                            'alt' => $blog->title,
                            'fallback' => 'images/gallery/portrait/pic1.jpg',
                        ])
                    </td>
                    <td><strong>{{ $blog->title }}</strong></td>
                    <td>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at?->format('M d, Y') ?? '—' }}</td>
                    <td>
                        @if($blog->is_published)
                        <span class="admin-badge admin-badge-success">Published</span>
                        @else
                        <span class="admin-badge admin-badge-warning">Draft</span>
                        @endif
                    </td>
                    <td>{{ $blog->sort_order }}</td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'viewUrl' => route('blog.show', $blog->slug),
                            'viewTarget' => '_blank',
                            'editUrl' => route('admin.blogs.edit', $blog),
                            'deleteUrl' => route('admin.blogs.destroy', $blog),
                            'deleteConfirm' => 'Delete this blog post?',
                        ])
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="admin-empty">
                            <i class="fa fa-newspaper-o"></i>
                            <p>No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Add your first post</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
