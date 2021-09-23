<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_cart', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
    $table->integer('product_id');
    $table->integer('child_id');
    $table->integer('quantity');
    

            $table->foreign('child_id')->references('id')->on('mia_product_child');$table->foreign('product_id')->references('id')->on('mia_product');$table->foreign('user_id')->references('id')->on('mia_user');

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
        Schema::dropIfExists('mia_cart');
    }
}