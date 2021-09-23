<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaProductQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_product_question', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
    $table->integer('user_id');
    $table->integer('parent_id');
    $table->text('caption');
    $table->integer('status');
    

            $table->foreign('parent_id')->references('id')->on('mia_product_question');$table->foreign('product_id')->references('id')->on('mia_product');$table->foreign('user_id')->references('id')->on('mia_user');

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
        Schema::dropIfExists('mia_product_question');
    }
}