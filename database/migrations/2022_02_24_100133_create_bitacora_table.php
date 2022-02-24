<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->integer('id');
            $table->string('url')->nullable();
            $table->integer('user_modifico')->nullable();
            $table->string('nombre_socio')->nullable();
            $table->string('dni_socio')->nullable();
            $table->string('nombre_propietario')->nullable();
            $table->string('dni_propietario')->nullable();
            $table->string('asociacione_id')->nullable();
            $table->string('tipo_documento_id')->nullable();
            $table->string('tipo_persona')->nullable();

            $table->string('num_placa', 30)->nullable();
            $table->date('expedicion')->nullable();
            $table->date('revalidacion')->nullable();
            $table->string('num_operacion', 120)->nullable();
            $table->string('vigencia_operacion', 120)->nullable();
            $table->string('num_autorizacion', 120)->nullable();
            $table->string('vigencia_autorizacion', 120)->nullable();
            $table->integer('status')->nullable()->default(0); // Impreso - No Impreso
            $table->date('fecha_print')->nullable();
            $table->integer('tipo')->nullable()->default(1); // Tarjeta o Fotocheck
            $table->string('num_correlativo')->nullable();
            $table->date('renovado')->nullable();
            $table->integer('renovado_count')->defaul(0)->nullable();
            $table->integer('socio_id')->nullable();
            $table->integer('vehiculo_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('suministro_id')->nullable();
            $table->integer('disenio_id')->nullable();
            $table->date('created_at')->nullable();
            $table->string('image')->nullable();
            $table->string('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
