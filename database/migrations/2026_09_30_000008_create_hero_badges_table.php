<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_badges', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Laravel", "MikroTik", "Cisco"
            $table->string('icon_class')->nullable(); // e.g. "fab fa-laravel", "fas fa-network-wired"
            $table->string('icon_color')->default('#6366f1'); // hex or css color
            $table->string('image')->nullable(); // optional uploaded logo image
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_badges');
    }
};
