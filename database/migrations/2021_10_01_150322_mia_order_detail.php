<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_order_detail', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id');
    $table->integer('product_id');
    $table->decimal('amount', $presision = 12, $scale = 2);
    $table->integer('type_id');
    $table->string('group');
    

            $table->foreign('order_id')->references('id')->on('mia_order');$table->foreign('product_id')->references('id')->on('mia_product');

            

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_order_detail');
    }
}