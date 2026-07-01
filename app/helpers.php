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

if (! function_exists('footer_menu_links')) {
    function footer_menu_links(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        $links = [];

        foreach (preg_split('/\r\n|\r|\n/', trim($raw)) as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            if (str_contains($line, '|')) {
                [$label, $url] = array_map('trim', explode('|', $line, 2));
            } else {
                $label = $line;
                $url = '#';
            }

            if ($label !== '') {
                $links[] = ['label' => $label, 'url' => $url ?: '#'];
            }
        }

        return $links;
    }
}

if (! function_exists('youtube_video_id')) {
    function youtube_video_id(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        if (! preg_match('~^https?://~i', $url)) {
            $url = 'https://' . ltrim($url, '/');
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

if (! function_exists('youtube_embed_url')) {
    function youtube_embed_url(?string $url, bool $autoplay = true): ?string
    {
        $videoId = youtube_video_id($url);

        if (! $videoId) {
            return null;
        }

        $params = $autoplay ? '?autoplay=1&rel=0' : '?rel=0';

        return 'https://www.youtube.com/embed/' . $videoId . $params;
    }
}

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        $settings = view()->shared('settings', []);

        return $settings[$key] ?? $default;
    }
}
