<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuministrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suministros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->integer('monto_pvc');
            $table->integer('conteo_monto_pvc')->nullable();
            $table->integer('monto_cinta');
            $table->integer('conteo_monto_cinta')->nullable();
            $table->integer('monto_holograma');
            $table->integer('conteo_monto_holograma')->nullable();
            $table->integer('monto_pruebas')->nullable();
            $table->date('fecha_adquisicion');
            $table->date('fecha_utilizacion')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('status')->default(0)->nullable();
            // $table->date('fecha_entrega_impresion')->nullable(); // Tarjeta o Fotocheck
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
        Schema::dropIfExists('suministros');
    }
}
