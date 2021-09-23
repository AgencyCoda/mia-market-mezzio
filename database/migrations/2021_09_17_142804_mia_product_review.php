<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaProductReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_product_review', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
    $table->integer('user_id');
    $table->decimal('rating', $presision = 12, $scale = 2);
    $table->text('caption');
    $table->integer('status');
    

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
        Schema::dropIfExists('mia_product_review');
    }
}