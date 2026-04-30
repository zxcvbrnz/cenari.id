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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 12, 2);
            $table->string('snap_token')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled

            // Snapshot Alamat Pengiriman
            $table->string('recipient_name');
            $table->string('phone_number');
            $table->text('full_address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('postal_code');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
