@php
    $path = $path ?? null;
    $fallback = $fallback ?? 'images/logo-dark.png';
    $alt = $alt ?? '';
    $size = $size ?? 'md';
@endphp

@if($path)
<img
    src="{{ media_url($path, $fallback) }}"
    alt="{{ $alt }}"
    class="admin-table-thumb admin-table-thumb--{{ $size }}"
>
@else
<span class="admin-table-thumb-empty">—</span>
@endif
