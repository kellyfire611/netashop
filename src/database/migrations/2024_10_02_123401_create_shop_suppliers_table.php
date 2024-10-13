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
        Schema::create('shop_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigIncrement - số nguyên không dấu tự tăng
            $table->string('supplier_code', 50);
            $table->text('supplier_name');
            $table->text('description');
            $table->text('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_suppliers');
    }
};
