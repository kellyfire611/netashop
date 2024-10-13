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
        Schema::create('shop_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('password', 500);
            $table->string('last_name');
            $table->string('first_name');
            $table->boolean('gender');
            $table->string('email');
            $table->dateTime('birthday');
            $table->string('avatar', 500);
            $table->string('code');
            $table->string('phone');
            $table->string('company');
            $table->string('billing_address', 500);
            $table->string('shipping_address', 500);
            $table->string('city');
            $table->string('state');
            $table->string('postal_code', 15);
            $table->string('country');
            $table->string('remember_token');
            $table->string('activate_code');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_customers');
    }
};