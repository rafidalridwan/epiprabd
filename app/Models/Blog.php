<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'is_published',
        'sort_order',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(BlogImage::class)->orderBy('sort_order');
    }

    public function sliderItems(): Collection
    {
        $galleryImages = $this->relationLoaded('images')
            ? $this->images
            : $this->images()->get();

        if ($galleryImages->isNotEmpty()) {
            return $galleryImages;
        }

        if ($this->image) {
            return collect([
                new BlogImage([
                    'image' => $this->image,
                ]),
            ]);
        }

        return collect();
    }
}
