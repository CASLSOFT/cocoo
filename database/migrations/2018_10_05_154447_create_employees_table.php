<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('typecc', ['CC', 'TI', 'Otro']);
            $table->enum('area', ['administracion', 'comercial', 'farmacia']);;
            $table->integer('identificacion')->unsigned();
            $table->String('firstname', 100);
            $table->String('lastname', 100);
            $table->string('email')->unique();
            $table->string('CO', 3);
            $table->string('type_nomina', 1)->nullable();
            $table->date('admissiondate');
            $table->date('retirementdate')->nullable();
            $table->integer('salary')->unsigned();
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
        Schema::dropIfExists('employees');
    }
}
