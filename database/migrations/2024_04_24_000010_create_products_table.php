<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2);
            $table->decimal('price_with_profit', 15, 2);
            $table->string('slug')->unique();
            $table->string('product_code')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
