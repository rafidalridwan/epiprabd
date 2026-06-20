<?php

if (! function_exists('media_url')) {
    function media_url(?string $path, string $fallback = 'images/logo-dark.png'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        return asset($path);
    }
}

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        $settings = view()->shared('settings', []);

        return $settings[$key] ?? $default;
    }
}
