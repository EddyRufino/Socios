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
            $table->date('expedicion');
            $table->date('revalidacion');
            $table->string('image')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('tipo')->nullable()->default(2);
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
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
