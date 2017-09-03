<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSignosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('signos', function(Blueprint $table) {
            $table->integer('id', true);
            $table->float('pulso', 10, 0);
            $table->float('so', 10, 0);
            $table->dateTime('fecha_signo');
            $table->integer('paciente_id', 11)->unsigned();
            $table->integer('cubiculo')->nullable();
            $table->boolean('lectura')->nullable();

            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('signos');
    }

}
