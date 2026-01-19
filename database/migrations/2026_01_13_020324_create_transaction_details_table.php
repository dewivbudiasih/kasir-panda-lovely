<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade'); // JANGAN PAKAI ->unique()
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
