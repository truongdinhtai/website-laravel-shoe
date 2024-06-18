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
        Schema::create('products_wholesale_price', function (Blueprint $table) {
            $table->id();
            $table->integer('form')->default(0)->nullable();
            $table->integer('to')->default(0)->nullable();
            $table->char('unit_price')->nullable()->default('price')->comment('price|contact');
            $table->integer('price')->default(0)->nullable();
            $table->integer('product_id')->nullable()->default(0);
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
        Schema::dropIfExists('products_wholesale_price');
    }
};
