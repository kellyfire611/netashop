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
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->dateTime('order_date');
            $table->dateTime('shipped_date');
            $table->string('ship_name', 50);
            $table->string('ship_address1', 500);
            $table->string('ship_address2', 500);
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_postal_code', 50);
            $table->string('ship_country');
            $table->decimal('shipping_fee', 16, 0);
            $table->bigInteger('payment_type_id')->unsigned();
            $table->dateTime('paid_date');
            $table->string('order_status');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('acl_users');
            $table->foreign('customer_id')->references('id')->on('shop_customers');
            $table->foreign('payment_type_id')->references('id')->on('shop_payment_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};