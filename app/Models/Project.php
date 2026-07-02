<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Project extends Model
{
    protected $fillable = [
        'project_category_id', 'title', 'slug', 'excerpt', 'description',
        'image', 'banner_image', 'project_date', 'client', 'project_type',
        'creative_director', 'latitude', 'longitude',
        'is_published', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'project_date' => 'date',
            'latitude' => 'float',
            'longitude' => 'float',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function hasCoordinates(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function sliderImages(): Collection
    {
        return $this->sliderItems()->pluck('image')->filter();
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
                new ProjectImage([
                    'image' => $this->image,
                    'youtube_url' => null,
                ]),
            ]);
        }

        return collect();
    }

    public function getCategoryClassAttribute(): string
    {
        return 'cat-' . ($this->project_category_id ?? 0);
    }
}
