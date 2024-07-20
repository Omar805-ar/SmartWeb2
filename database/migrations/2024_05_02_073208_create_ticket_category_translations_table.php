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
        Schema::create('ticket_category_translations', function (Blueprint $table) {
            $table->id();

            $table->string('locale')->index();
            $table->string('name');

            
            $table->foreignId('ticket_category_id');
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['ticket_category_id', 'locale']);
            
            $table->timestamps();
        });
    }

    /**workbench
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_category_translations');
    }
};
