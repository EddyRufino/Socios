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
            $table->string('url')->nullable();
            $table->string('num_placa', 30)->nullable()->unique();
            $table->date('expedicion')->nullable();
            $table->date('revalidacion')->nullable();
            $table->string('num_operacion', 120)->nullable();
            $table->string('vigencia_operacion', 120)->nullable();
            $table->string('num_autorizacion', 120)->nullable();
            $table->string('vigencia_autorizacion', 120)->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('tipo')->nullable()->default(1); // Tarjeta o Fotocheck
            $table->string('num_correlativo')->unique();
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
            $table->foreignId('user_id')->nullable()->constrained('users');
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
