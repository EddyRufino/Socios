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
            $table->string('dni_socio', 8)->nullable();
            $table->string('dni_propietario', 8)->nullable();
            $table->string('num_placa', 30)->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('asociacione_id')->nullable()->constrained('asociaciones')->onDelete('cascade');
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
