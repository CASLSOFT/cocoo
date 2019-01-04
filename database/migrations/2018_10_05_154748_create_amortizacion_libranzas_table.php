<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmortizacionLibranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amortizacion_libranzas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuota_mensual')->unsigned();
            $table->integer('cuota_quincenal')->unsigned()->default(0);
            $table->integer('cuota_de')->unsigned()->default(0);
            $table->integer('cuota_hasta')->unsigned()->default(0);
            $table->string('entidad');
            $table->string('category');
            $table->date('fecha_inic');
            $table->date('fecha_final');
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
        Schema::dropIfExists('amortizacion_libranzas');
    }
}
