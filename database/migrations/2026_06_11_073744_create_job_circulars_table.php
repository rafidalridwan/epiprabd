<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_circulars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->string('department')->nullable();
            $table->string('job_type')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('vacancies')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('show_on_home')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_circulars');
    }
};
