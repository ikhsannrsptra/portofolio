<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('years_exp')->nullable()->change();
            $table->string('projects_completed')->nullable()->change();
            $table->string('certificates_count')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('years_exp')->nullable(false)->change();
            $table->string('projects_completed')->nullable(false)->change();
            $table->string('certificates_count')->nullable(false)->change();
        });
    }
};
