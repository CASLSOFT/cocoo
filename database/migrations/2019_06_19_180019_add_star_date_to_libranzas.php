<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStarDateToLibranzas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libranzas', function (Blueprint $table) {
            $table->date('startdate')->nullable()->after('first_quincena');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libranzas', function (Blueprint $table) {
            $table->dropColumn('startdate');
        });
    }
}
