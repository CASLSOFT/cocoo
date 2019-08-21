<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('trademark', 20); //marca de fabrica
            $table->string('unit', 50); //Unidad
            $table->integer('cost'); //Costo
            $table->integer('tariff'); //Tafira
            $table->integer('provider_id')->unsigned();
            $table->string('category', 50);
            $table->string('imagen')->nullable();
            $table->string('description');
            $table->boolean('status')->default('1');
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
