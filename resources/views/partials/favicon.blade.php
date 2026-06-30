@php
    $faviconPath = setting('favicon');
    $faviconUrl = $faviconPath ? media_url($faviconPath, 'images/favicon.ico') : asset('images/favicon.ico');
    $extension = $faviconPath ? strtolower(pathinfo($faviconPath, PATHINFO_EXTENSION)) : 'ico';
    $faviconType = match ($extension) {
        'png' => 'image/png',
        'svg' => 'image/svg+xml',
        'jpg', 'jpeg' => 'image/jpeg',
        default => 'image/x-icon',
    };
@endphp
<link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
@if(in_array($extension, ['png', 'jpg', 'jpeg'], true))
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">
@endif
