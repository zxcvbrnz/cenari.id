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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Bagus untuk SEO URL
            $table->string('date_string');    // Menyimpan "25 Maret 2024"
            $table->string('time_string');    // Menyimpan "09:00 - 15:00 WIB"
            $table->string('type');           // Workshop, Seminar, Bootcamp
            $table->string('image');
            $table->string('status');
            $table->string('price');          // Kita gunakan string karena ada nilai 'Free'
            $table->string('color')->default('#3B82F6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};