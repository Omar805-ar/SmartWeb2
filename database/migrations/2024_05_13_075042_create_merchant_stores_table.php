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
        Schema::create('merchant_stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name')->unique();
            $table->string('logo');
            $table->foreignId('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_stores');
    }
};
