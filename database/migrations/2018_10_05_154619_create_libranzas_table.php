<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libranzas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuota_mensual')->unsigned();
            $table->integer('cuota_quincenal')->unsigned()->default(0);
            $table->integer('cuota_de')->unsigned()->default(0);
            $table->integer('cuota_hasta')->unsigned()->default(0);
            $table->string('entidad');
            $table->string('category');
            $table->boolean('status')->default(true);
            $table->integer('employee_id')->unsigned();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libranzas');
    }
}
