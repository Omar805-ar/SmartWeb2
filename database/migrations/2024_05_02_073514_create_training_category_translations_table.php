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
        Schema::create('training_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_category_id');
            $table->string('locale')->index();

            $table->string('name');
            $table->string('meta_description', 301);
            $table->foreign('training_category_id')->references('id')->on('training_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_category_translations');
    }
};
