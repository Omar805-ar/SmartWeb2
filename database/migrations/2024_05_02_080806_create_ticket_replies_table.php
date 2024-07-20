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
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            
            $table->enum('sender', ['admin', 'merchant']);
            
            $table->foreignId('merchant_id')->nullable();
            $table->foreignId('admin_id')->nullable();

            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnDelete()->cascadeOnUpdate();

            $table->longText('message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_replies');
    }
};
