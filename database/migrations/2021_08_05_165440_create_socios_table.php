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
            $table->string('nombre_socio', 120);
            $table->string('nombre_propietario', 120)->nullable();
            $table->string('dni_socio', 30)->nullable();
            $table->string('dni_propietario', 30)->nullable();
            $table->string('num_placa', 30)->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('asociacione_id')->nullable()->constrained('asociaciones')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('tipo_persona')->nullable();
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
