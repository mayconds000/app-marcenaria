<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('environment_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->timestamps();
            $talbe->softDeletes();
            $table->foreign('environment_id')->references('id')->on('environment')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('environment_order');
    }
}
