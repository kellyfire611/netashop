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
        Schema::create('acl_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 191);
            $table->string('password', 500);
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->boolean('gender', 3)->nullable();
            $table->string('email', 191);
            $table->dateTime('birthday')->nullable();
            $table->string('avatar', 500)->nullable();
            $table->string('code')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->bigInteger('manager_id')->unsigned()->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('address1', 500)->nullable();
            $table->string('address2', 500)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code', 15)->nullable();
            $table->string('country')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('active_code')->nullable();
            $table->boolean('status', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acl_users');
    }
};