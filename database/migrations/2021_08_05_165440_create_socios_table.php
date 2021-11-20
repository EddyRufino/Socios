<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_socio');
            $table->string('nombre_propietario')->nullable();
            $table->string('dni_socio')->nullable();
            $table->string('dni_propietario')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->nullable()->default(0); // Puede Servir cuando es P.N
            $table->foreignId('asociacione_id')->nullable()->constrained('asociaciones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socios');
    }
}
