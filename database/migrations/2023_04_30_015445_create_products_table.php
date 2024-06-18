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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('hot')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('price')->default(0);
            $table->boolean('is_wholesale')->default(false)->nullable();
            $table->integer('count_buy')->default(0);
            $table->integer('number')->default(0);
            $table->tinyInteger('sale')->default(0);
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('products');
    }
};
