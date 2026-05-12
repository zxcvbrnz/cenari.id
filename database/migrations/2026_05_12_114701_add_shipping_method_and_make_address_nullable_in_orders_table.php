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
        Schema::table('orders', function (Blueprint $table) {
            // 1. Tambahkan kolom metode pengiriman
            $table->string('shipping_method')->default('cod')->after('status'); // 'cod' atau 'send'

            // 2. Ubah kolom alamat menjadi nullable agar bisa dikosongkan saat COD
            $table->text('full_address')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('district')->nullable()->change();
            $table->string('village')->nullable()->change();
            $table->string('postal_code')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_method');

            // Kembalikan ke NOT NULL jika diperlukan (opsional)
            $table->string('recipient_name')->nullable(false)->change();
            // ... dst
        });
    }
};