<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_socio', 120);
            $table->string('nombre_propietario', 120)->nullable();
            $table->string('dni_socio', 8)->nullable();
            $table->string('dni_propietario', 8)->nullable();
            $table->string('url')->nullable();
            $table->string('num_placa', 30)->nullable()->unique();
            $table->date('expedicion');
            $table->date('revalidacion');
            $table->string('num_operacion', 120)->unique();
            $table->string('vigencia_operacion', 120)->unique();
            $table->string('num_autorizacion', 120)->nullable();
            $table->string('vigencia_autorizacion', 120)->nullable();
            $table->integer('num_correlativo')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
            $table->foreignId('asociacione_id')->constrained('asociaciones')->nullable();
            $table->foreignId('correlativo_id')->constrained('correlativos')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('tarjetas');
    }
}
