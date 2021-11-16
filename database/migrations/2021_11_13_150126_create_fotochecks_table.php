<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotochecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotochecks', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_socio', 120);
            $table->string('dni_socio', 8)->unique();
            $table->string('url')->nullable();
            $table->date('expedicion');
            $table->date('revalidacion');
            $table->string('image')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->nullable();
            $table->foreignId('asociacione_id')->constrained('asociaciones')->nullable();
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
        Schema::dropIfExists('fotochecks');
    }
}
