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
        Schema::table('merchant_stores', function (Blueprint $table) {
            $table->enum('color', ['avy','orange','pink','purple','red','violet','yellow','fuchsia','sky','grape']);
            $table->string('api_key')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchant_stores', function (Blueprint $table) {
            //
        });
    }
};
