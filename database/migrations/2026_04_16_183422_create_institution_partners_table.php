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
        Schema::create('institution_partners', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_institusi');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('tujuan_surat'); // Kepada Yth.
            $table->text('penawaran');      // Isi Penawaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institution_partners');
    }
};
