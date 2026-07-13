<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class JobApplication extends Model
{
    protected $fillable = [
        'job_circular_id',
        'name',
        'email',
        'phone',
        'message',
        'cv_path',
        'cv_original_name',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function jobCircular(): BelongsTo
    {
        return $this->belongsTo(JobCircular::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (JobApplication $application) {
            if ($application->cv_path && Storage::disk('local')->exists($application->cv_path)) {
                Storage::disk('local')->delete($application->cv_path);
            }
        });
    }
}
