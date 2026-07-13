<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('home_cards_title')->nullable()->after('work_spans_items');
            $table->string('home_cards_subtitle')->nullable()->after('home_cards_title');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['home_cards_title', 'home_cards_subtitle']);
        });
    }
};
