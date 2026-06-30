<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->json('about_gallery_images')->nullable()->after('facts_stats');
            $table->string('about_button_text')->nullable()->after('about_gallery_images');
            $table->string('about_button_link')->nullable()->after('about_button_text');
            $table->string('experts_heading')->nullable()->after('about_button_link');
            $table->string('experts_bg_image')->nullable()->after('experts_heading');
            $table->boolean('show_experts_section')->default(true)->after('experts_bg_image');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'about_gallery_images',
                'about_button_text',
                'about_button_link',
                'experts_heading',
                'experts_bg_image',
                'show_experts_section',
            ]);
        });
    }
};
