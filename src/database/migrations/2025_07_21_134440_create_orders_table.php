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
            $table->string('name');        // Nama pembeli
            $table->string('phone');       // No HP
            $table->string('address');     // Alamat
            $table->json('items');         // Daftar item (json)
            $table->decimal('total', 12, 2); // Total harga
            $table->string('status')->default('pending'); // Status order
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
