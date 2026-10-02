<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('level'); // Kuliah, SMK, SMP
            $table->string('period'); // e.g. 2020 - 2024
            $table->string('title'); // e.g. S1 Teknik Informatika
            $table->string('institution'); // e.g. Universitas X
            $table->text('description')->nullable();
            $table->string('badge_color')->default('var(--accent-cyan)');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
