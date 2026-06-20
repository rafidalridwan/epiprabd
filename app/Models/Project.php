<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'project_category_id', 'title', 'slug', 'excerpt', 'description',
        'image', 'banner_image', 'project_date', 'client', 'project_type',
        'creative_director', 'is_published', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'project_date' => 'date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function getCategoryClassAttribute(): string
    {
        return 'cat-' . ($this->project_category_id ?? 0);
    }
}
