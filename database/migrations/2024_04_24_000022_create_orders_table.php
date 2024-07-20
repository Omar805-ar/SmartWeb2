<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('shipping_cost', 15, 2);
            $table->decimal('grand_total', 15, 2);
            $table->string('city');
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('notes')->nullable();
            
            $table->enum('status', [
                'pending', 'approved', 'unapproved', 'in_way', 'delivered', 'returned', 'rejected'
            ])->default('pending');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
