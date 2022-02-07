<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisenioIdToTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarjetas', function (Blueprint $table) {
            // $table->foreignId('disenio_id')->constrained('disenios')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarjetas', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['tarjetas_disenio_id_foreign']);

            // 2. Drop the column
            $table->dropColumn('disenio_id');
        });
    }
}
