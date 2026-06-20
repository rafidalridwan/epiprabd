<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title', 'banner_title', 'banner_image', 'intro_image',
        'meta_title', 'meta_description', 'subtitle',
        'heading', 'content', 'content_secondary',
        'who_subtitle', 'who_heading', 'who_content',
        'who_badge_strong', 'who_badge_span',
        'facts_subtitle', 'facts_heading', 'facts_content',
        'facts_bg_image', 'facts_stats', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'facts_stats' => 'array',
        ];
    }
}
