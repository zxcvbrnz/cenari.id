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
        Schema::create('kit_robotics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('discount')->default(0);
            $table->text('description')->nullable();
            $table->decimal('pelatihan_price', 12, 2)->nullable();
            $table->decimal('private_price', 12, 2)->nullable();
            $table->foreignId('course_package_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kit_robotics');
    }
};