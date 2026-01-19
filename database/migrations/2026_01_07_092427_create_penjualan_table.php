<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            
            $table->string('nomor_invoice');
            $table->foreignId('id_kasir')->constrained('users');
            
            $table->decimal('total_bayar', 15, 2);
            $table->decimal('uang_diterima', 15, 2);
            $table->decimal('kembalian', 15, 2);
            $table->string('metode_pembayaran');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};