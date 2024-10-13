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
        Schema::create('shop_posts_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_category_code', 500);
            $table->string('post_category_name', 500);
            $table->mediumText('description');
            $table->mediumText('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_posts_categories');
    }
};