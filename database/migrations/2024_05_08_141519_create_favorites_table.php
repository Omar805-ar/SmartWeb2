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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('merchant_id');
            $table->foreign('merchant_id')
            ->references('id')->on('merchants')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->integer('quantity')->unsigned()->default(0);

            $table->decimal('total', 15, 2);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
