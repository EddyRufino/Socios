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
            $table->string('num_operacion', 120)->nullable();
            $table->string('vigencia_operacion', 120)->nullable();
            $table->string('num_autorizacion', 120)->nullable();
            $table->string('vigencia_autorizacion', 120)->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('tipo')->nullable()->default(1);
            $table->string('num_correlativo')->unique();
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
            $table->foreignId('asociacione_id')->nullable()->constrained('asociaciones')->default(1); // Modifica en la DB que es NULL - no lo agarra ---- 0 es para persona natural
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
        Schema::dropSoftDeletes('tarjetas');
    }
}
