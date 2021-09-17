<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_store', function (Blueprint $table) {
            $table->id();

            $table->string('title');
    $table->string('slug');
    $table->integer('category_id');
    $table->text('caption');
    $table->text('photos');
    $table->text('address');
    $table->string('address_number');
    $table->integer('city_id');
    $table->string('zip_code');
    $table->text('photo_featured');
    $table->text('website');
    $table->text('facebook');
    $table->text('instagram');
    $table->text('twitter');
    $table->text('vision');
    

            $table->foreign('category_id')->references('id')->on('mia_category');$table->foreign('city_id')->references('id')->on('mia_city');

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
        Schema::dropIfExists('mia_store');
    }
}