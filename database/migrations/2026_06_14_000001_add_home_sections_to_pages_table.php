<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('intro_image')->nullable()->after('banner_image');
            $table->string('who_subtitle')->nullable()->after('content_secondary');
            $table->string('who_heading')->nullable()->after('who_subtitle');
            $table->text('who_content')->nullable()->after('who_heading');
            $table->string('who_badge_strong')->nullable()->after('who_content');
            $table->string('who_badge_span')->nullable()->after('who_badge_strong');
            $table->string('facts_subtitle')->nullable()->after('who_badge_span');
            $table->string('facts_heading')->nullable()->after('facts_subtitle');
            $table->text('facts_content')->nullable()->after('facts_heading');
            $table->string('facts_bg_image')->nullable()->after('facts_content');
            $table->json('facts_stats')->nullable()->after('facts_bg_image');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'intro_image',
                'who_subtitle',
                'who_heading',
                'who_content',
                'who_badge_strong',
                'who_badge_span',
                'facts_subtitle',
                'facts_heading',
                'facts_content',
                'facts_bg_image',
                'facts_stats',
            ]);
        });
    }
};
