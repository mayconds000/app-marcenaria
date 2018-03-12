<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('cnpj', 20)->nullable();
            $table->string('cpf', 20)->nullable();
            $table->string('address', 60);
            $table->string('number', 10);
            $table->string('neightborhood', 30);
            $table->string('city', 30);
            $table->string('state', 2);
            $table->string('phone1', 20);
            $table->string('phone2', 20);
            $table->string('observation');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                            ->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
