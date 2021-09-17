<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaProductChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_product_child', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
    $table->integer('stock');
    $table->integer('color_type');
    $table->string('group');
    

            $table->foreign('product_id')->references('id')->on('mia_product');

            

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_product_child');
    }
}