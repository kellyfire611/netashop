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
        Schema::create('shop_product_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->text('discount_name');
            $table->decimal('discount_amount');
            $table->boolean('is_fixed')->comment('#True: giảm theo số tiền cố định; #False: giảm theo %');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();

            // References
            $table->foreign('product_id')
                ->references('id')
                ->on('shop_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_product_discounts');
    }
};
