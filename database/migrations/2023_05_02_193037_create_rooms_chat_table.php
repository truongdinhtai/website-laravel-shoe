<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->integer('product_id')->default(0)->nullable();
            $table->integer('auth_id')->default(0)->nullable();
            $table->timestamps();
        });
        Schema::create('rooms_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id')->default(0)->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('rooms_chats');
    }
};
