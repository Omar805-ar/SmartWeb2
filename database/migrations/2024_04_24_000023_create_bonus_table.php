<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusTable extends Migration
{
    public function up()
    {
        Schema::create('bonus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('min_orders');
            $table->decimal('minimum_order_amount', 15, 2);
            $table->decimal('bonus', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
