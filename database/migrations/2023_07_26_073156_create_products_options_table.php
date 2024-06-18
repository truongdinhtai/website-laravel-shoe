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
        Schema::create('products_options', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->nullable();
            $table->string('option_name')->nullable();
            $table->integer('category_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('products_value', function (Blueprint $table) {
            $table->id();
            $table->integer('product_option_id')->index()->nullable();
            $table->string('name_value')->nullable();
            $table->integer('category_id')->index()->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('product_id')->index()->nullable();
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
        Schema::dropIfExists('products_options');
        Schema::dropIfExists('products_value');
    }
};
