<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_product_stock', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
    $table->integer('user_id');
    $table->integer('val');
    $table->integer('type');
    

            $table->foreign('product_id')->references('id')->on('mia_product');$table->foreign('user_id')->references('id')->on('mia_user');

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
        Schema::dropIfExists('mia_product_stock');
    }
}