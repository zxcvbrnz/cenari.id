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
        Schema::create('collaborations', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama instansi/partner
        $table->string('image'); // Path file gambar/logo
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0); // Untuk mengatur urutan logo
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};