<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('approval_id')->default('0');
            $table->string('category');
            $table->date('dateapproval')->nullable();
            $table->date('datereceived')->nullable();
            $table->boolean('ordergenerated')->default('0');
            $table->boolean('draft')->default('1');
            $table->string('observations')->nullable();
            $table->string('area');
            $table->enum('status', ['BORRADOR', 'APROBACION', 'COMPRANDO', 'DESPACHO', 'RECIBIDO'])->default('BORRADOR');
            $table->unsignedInteger('puntuacion')->default('0');
            $table->string('responsable')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
