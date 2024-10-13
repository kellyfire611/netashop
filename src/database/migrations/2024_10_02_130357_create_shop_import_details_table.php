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
        Schema::create('shop_import_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('import_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('quantity', 16, 0);
            $table->decimal('unit_price', 16, 0);
            $table->timestamps();

            $table->foreign('import_id')->references('id')->on('shop_imports');
            $table->foreign('product_id')->references('id')->on('shop_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_import_details');
    }
};