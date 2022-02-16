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
            $table->string('url')->nullable();
            $table->date('expedicion')->nullable();
            $table->date('revalidacion')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->date('fecha_print')->nullable();
            $table->string('num_placa', 30)->nullable()->unique();
            $table->integer('tipo')->nullable()->default(2);
            $table->date('renovado')->nullable();
            $table->integer('renovado_count')->defaul(0)->nullable();
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
        Schema::dropSoftDeletes('fotochecks');
    }
}
