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
        'facts_bg_image', 'facts_stats',
        'about_gallery_images', 'about_button_text', 'about_button_link',
        'experts_heading', 'experts_bg_image', 'show_experts_section',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'facts_stats' => 'array',
            'about_gallery_images' => 'array',
            'show_experts_section' => 'boolean',
        ];
    }

    public function isBannerOnly(): bool
    {
        return in_array($this->slug, ['projects', 'career'], true);
    }
}
