@extends('admin.layout')

@section('title', 'Home Cards')
@section('breadcrumb', 'Home Cards')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Home Cards</h1>
        <p>Manage service cards (image, title, subtitle, and details popup).</p>
    </div>
    <a href="{{ route('admin.home-cards.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa fa-plus"></i> Add Card
    </a>
</div>

@if($homePage)
<div class="admin-card" style="margin-bottom:1.5rem;">
    <div class="admin-card-body">
        <h2 style="margin:0 0 0.5rem;font-size:1.1rem;">Section Heading</h2>
        <p class="admin-form-hint" style="margin-top:0;margin-bottom:1rem;">Common title and subtitle shown above the cards on the home page.</p>
        <form method="POST" action="{{ route('admin.home-cards.section') }}">
            @csrf
            @method('PUT')
            <div class="admin-form-group">
                <label for="home_cards_title">Title</label>
                <input id="home_cards_title" class="form-control" name="home_cards_title" value="{{ old('home_cards_title', $homePage->home_cards_title) }}" placeholder="What We Do">
                @error('home_cards_title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="admin-form-group">
                <label for="home_cards_subtitle">Subtitle</label>
                <input id="home_cards_subtitle" class="form-control" name="home_cards_subtitle" value="{{ old('home_cards_subtitle', $homePage->home_cards_subtitle) }}" placeholder="Short supporting line for this section">
                @error('home_cards_subtitle')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fa fa-save"></i> Save Section Heading
            </button>
        </form>
    </div>
</div>
@endif

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:90px;">Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cards as $card)
                <tr>
                    <td>@include('admin.partials.image-thumb', ['path' => $card->image, 'alt' => $card->title, 'fallback' => 'images/gallery/portrait/pic1.jpg', 'size' => 'lg'])</td>
                    <td><strong>{{ $card->title }}</strong></td>
                    <td>{{ $card->subtitle ?? '—' }}</td>
                    <td>{{ $card->sort_order }}</td>
                    <td>
                        @if($card->is_active)
                        <span class="admin-badge admin-badge-success">Active</span>
                        @else
                        <span class="admin-badge admin-badge-muted">Hidden</span>
                        @endif
                    </td>
                    <td class="admin-actions">
                        @include('admin.partials.table-actions', [
                            'editUrl' => route('admin.home-cards.edit', $card),
                            'deleteUrl' => route('admin.home-cards.destroy', $card),
                            'deleteConfirm' => 'Delete this home card?',
                        ])
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="admin-empty">
                            <i class="fa fa-th-large"></i>
                            <p>No home cards yet. <a href="{{ route('admin.home-cards.create') }}">Add your first card</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
