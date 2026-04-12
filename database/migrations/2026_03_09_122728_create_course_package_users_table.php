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
        Schema::create('course_package_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_package_id')->constrained()->onDelete('cascade');

            $table->string('username');
            $table->string('password');
            $table->enum('learning_methode', ['Online', 'Offline', 'Hybrid']);
            $table->enum('payment_status', ['Pending', 'Paid']);
            $table->enum('status', ['Diproses', 'Sedang Berjalan', 'Selesai'])->default('Diproses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_package_user');
    }
};
