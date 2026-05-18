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
        Schema::table('missing_links', function (Blueprint $table) {
            // 1. Hapus kolom url yang lama
            $table->dropColumn('url');

            // 2. Tambahkan foreignId baru yang terhubung ke tabel programs
            // constrained() otomatis mendeteksi nama tabel 'programs' dari prefix nama kolomnya
            // onDelete('cascade') opsional: jika program dihapus, missing_link terkait juga akan terhapus
            $table->foreignId('program_id')->default(0)->after('cta')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missing_links', function (Blueprint $table) {
            // 1. Hapus foreign key dan kolom program_id jika rollback dilakukan
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');

            // 2. Kembalikan kolom url seperti semula
            $table->string('url')->after('cta');
        });
    }
};