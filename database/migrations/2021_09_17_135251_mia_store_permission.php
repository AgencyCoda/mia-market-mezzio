<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaStorePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_store_permission', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
    $table->integer('store_id');
    $table->integer('role');
    

            $table->foreign('store_id')->references('id')->on('mia_store');$table->foreign('user_id')->references('id')->on('mia_user');

            

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_store_permission');
    }
}