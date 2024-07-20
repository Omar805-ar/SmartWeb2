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
        Schema::table('faq_category_translations', function (Blueprint $table) {
            $table->foreignId('faq_category_id');
            $table->string('locale')->index();
            $table->string('category');
            $table->foreign('faq_category_id')->references('id')->on('faq_categories')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faq_category_translations', function (Blueprint $table) {
            //
        });
    }
};
