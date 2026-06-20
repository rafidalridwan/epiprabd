<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCircular extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'description',
        'department', 'job_type', 'location', 'vacancies',
        'deadline', 'is_published', 'show_on_home', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'is_published' => 'boolean',
            'show_on_home' => 'boolean',
        ];
    }

    public function isOpen(): bool
    {
        if (! $this->deadline) {
            return true;
        }

        return $this->deadline->isFuture() || $this->deadline->isToday();
    }
}
