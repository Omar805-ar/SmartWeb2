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
        Schema::create('merchant_store_orders', function (Blueprint $table) {
            $table->id();

            $table->decimal('subtotal', 15, 2);

            $table->decimal('shipping_cost', 15, 2);

            $table->decimal('grand_total', 15, 2);

            $table->string('city');
            
            $table->string('address');
            
            $table->string('address_2')->nullable();
            
            $table->string('notes')->nullable();

            $table->unsignedBigInteger('client_id')->nullable();
            
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('government_id');
            
            $table->foreign('government_id')->references('id')->on('governments')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('store_id');

            $table->foreign('store_id')->references('id')->on('merchant_stores')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_store_orders');
    }
};
