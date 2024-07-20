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
        Schema::create('merchant_store_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('merchant_store_orders')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('quantity')->unsigned()->default(0);

            $table->decimal('price', 15, 2);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_store_order_items');
    }
};
