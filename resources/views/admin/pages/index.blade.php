@extends('admin.layout')

@section('title', 'Pages')
@section('breadcrumb', 'Pages')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Pages</h1>
        <p>Edit content for Home, About, and Contact pages.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:80px;">Banner</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>@include('admin.partials.image-thumb', ['path' => $page->banner_image, 'alt' => $page->title, 'fallback' => 'images/background/bg-11.jpg', 'size' => 'lg'])</td>
                    <td><strong>{{ $page->title }}</strong></td>
                    <td><code style="background:#f1f5f9;padding:0.15rem 0.5rem;border-radius:4px;font-size:0.8rem;">{{ $page->slug }}</code></td>
                    <td>
                        @if($page->is_published)
                        <span class="admin-badge admin-badge-success">Published</span>
                        @else
                        <span class="admin-badge admin-badge-warning">Draft</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'editUrl' => route('admin.pages.edit', $page),
                        ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
