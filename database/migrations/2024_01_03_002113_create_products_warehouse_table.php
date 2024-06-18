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
        Schema::create('products_warehouse', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable()->index();
            $table->integer('warehouse_id')->nullable()->index();
            $table->integer('qty')->default(0)->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->integer('total')->default(0)->nullable();
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
        Schema::dropIfExists('products_warehouse');
    }
};
