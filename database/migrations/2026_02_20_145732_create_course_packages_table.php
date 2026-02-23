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
        Schema::create('course_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade'); // Hubungan ke Program
            $table->string('slug')->unique();
            $table->string('name');
            $table->integer('level');
            $table->text('description')->nullable();
            $table->string('tool')->nullable();
            $table->integer('course_count');
            $table->integer('course_during');
            $table->decimal('price', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_packages');
    }
};