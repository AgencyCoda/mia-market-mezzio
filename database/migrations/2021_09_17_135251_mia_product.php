<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_product', function (Blueprint $table) {
            $table->id();

            $table->string('title');
    $table->string('sku');
    $table->string('slug');
    $table->text('photo_main');
    $table->integer('stock');
    $table->text('caption');
    $table->text('photos');
    $table->integer('store_id');
    

            $table->foreign('store_id')->references('id')->on('mia_store');

            $table->timestamps();

            $table->integer('deleted')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_product');
    }
}