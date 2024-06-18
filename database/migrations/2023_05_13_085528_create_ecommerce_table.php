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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->integer('total_discount')->nullable()->default(0);
            $table->integer('total_price')->default(0);
            $table->text('node')->nullable();
            $table->tinyInteger('order_type')->default(1)->nullable()->comment('1 đơn thường, 2 đơn sỉ');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->tinyInteger('shipping_status')->default(1)->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_address')->nullable();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->tinyInteger('status')->default(0)->comment('trạng thái đơn hàng');
            $table->integer('user_id')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('price')->default(0);
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('total_price')->default(0);
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('transactions');
    }
};
