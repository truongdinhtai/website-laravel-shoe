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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index()->nullable();
            $table->tinyInteger('number_vote')->nullable();
            $table->text('content_vote')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('user_id')->index()->nullable();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('total_vote')->default(0)->after('category_id')->nullable();
            $table->integer('total_stars')->default(0)->after('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['total_stars','total_vote']);
        });
    }
};
