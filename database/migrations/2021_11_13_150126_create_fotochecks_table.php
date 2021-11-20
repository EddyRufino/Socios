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
            $table->date('expedicion');
            $table->date('revalidacion');
            $table->string('image')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->foreignId('socio_id')->nullable()->constrained('socios');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
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
