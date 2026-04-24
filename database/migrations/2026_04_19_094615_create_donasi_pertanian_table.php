<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_pertanian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('jumlah', 15, 2);
            $table->string('metode_pembayaran')->default('transfer'); // transfer, ewallet, qris, dll
            $table->text('pesan')->nullable();
            $table->string('status')->default('pending'); // pending, success, failed, expired
            $table->string('payment_token')->nullable(); // untuk Midtrans nanti
            $table->string('order_id')->unique(); // unique order ID
            $table->timestamp('tanggal_donasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_pertanian');
    }
};
