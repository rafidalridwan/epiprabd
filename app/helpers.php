<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('media_url')) {
    function media_url(?string $path, string $fallback = 'images/logo-dark.png'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'uploads/')) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }

            // Legacy paths saved via storage disk + symlink
            if (file_exists(public_path('storage/' . $path))) {
                return asset('storage/' . $path);
            }

            return asset($path);
        }

        return asset($path);
    }
}

if (! function_exists('store_public_upload')) {
    function store_public_upload(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');
        $publicDir = public_path($directory);

        if (! is_dir($publicDir)) {
            mkdir($publicDir, 0755, true);
        }

        $filename = $file->hashName();
        $file->move($publicDir, $filename);

        return $directory . '/' . $filename;
    }
}

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        $settings = view()->shared('settings', []);

        return $settings[$key] ?? $default;
    }
}
