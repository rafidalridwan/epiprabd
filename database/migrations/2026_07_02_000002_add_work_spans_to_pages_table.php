<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('show_work_spans_section')->default(true)->after('facts_stats');
            $table->string('work_spans_heading')->nullable()->after('show_work_spans_section');
            $table->json('work_spans_items')->nullable()->after('work_spans_heading');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'show_work_spans_section',
                'work_spans_heading',
                'work_spans_items',
            ]);
        });
    }
};
