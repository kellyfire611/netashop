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
        Schema::create('shop_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('quantity', 16, 0);
            $table->decimal('unit_price', 16, 0);
            $table->float('discount_percentage');
            $table->double('discount_amount');
            $table->string('order_detail_status', 50);
            $table->dateTime('date_allocated');
            $table->timestamps();


            $table->foreign('order_id')->references('id')->on('shop_orders');
            $table->foreign('product_id')->references('id')->on('shop_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_order_details');
    }
};