<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Page::updateOrCreate(['slug' => 'projects'], [
            'title' => 'Projects',
            'banner_title' => 'Creating places that enhance the human experience.',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Projects',
            'is_published' => true,
        ]);

        Page::updateOrCreate(['slug' => 'career'], [
            'title' => 'Career',
            'banner_title' => 'Join our team — explore career opportunities',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Career',
            'is_published' => true,
        ]);
    }

    public function down(): void
    {
        Page::whereIn('slug', ['projects', 'career'])->delete();
    }
};
