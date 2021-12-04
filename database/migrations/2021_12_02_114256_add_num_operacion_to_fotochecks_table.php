<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumOperacionToFotochecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fotochecks', function (Blueprint $table) {
            $table->string('nombre_propietario', 100)->after('url')->nullable();
            $table->string('num_autorizacion', 200)->after('revalidacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fotocheck', function (Blueprint $table) {
            //
        });
    }
}
