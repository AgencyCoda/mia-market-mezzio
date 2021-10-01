<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_order', function (Blueprint $table) {
            $table->id();

            $table->integer('store_id');
    $table->integer('user_id');
    $table->integer('provider_id');
    $table->integer('status');
    $table->text('caption');
    $table->decimal('amount', $presision = 12, $scale = 2);
    $table->decimal('additional', $presision = 12, $scale = 2);
    $table->decimal('taxes', $presision = 12, $scale = 2);
    $table->decimal('discount', $presision = 12, $scale = 2);
    $table->decimal('total', $presision = 12, $scale = 2);
    $table->text('data_provider');
    $table->string('external_id');
    

            $table->foreign('store_id')->references('id')->on('mia_store');$table->foreign('user_id')->references('id')->on('mia_user');

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
        Schema::dropIfExists('mia_order');
    }
}