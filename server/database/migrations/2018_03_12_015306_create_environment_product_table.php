<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment_product', function (Blueprint $table) {
            $table->string('description');
            $table->decimal('value', 10, 2);
            $table->integer('quantity');
            $table->timestamps();
            $table->integer('environment_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('environment_id')->references('id')->on('environment_order')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('environment_product');
    }
}
