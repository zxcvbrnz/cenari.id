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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->text('content');      // Isi kutipan
            $table->string('author');    // Penulis (misal: Robert Greene)
            $table->string('source')->nullable(); // Sumber (misal: Mastery)
            $table->boolean('is_featured')->default(false); // Untuk tampil di section utama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
