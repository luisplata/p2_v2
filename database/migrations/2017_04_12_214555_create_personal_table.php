<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonalTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personal', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cedula')->unique();
            $table->string('nombre', 40);
            $table->string('telefono', 15);
            $table->enum('sexo', array('H', 'M'));
            $table->string('direccion', 100);
            $table->enum('tipo', array('DOCTOR', 'ENFERMERA', 'ADMISIONISTA', 'ENFERMERA_JEFE', 'ADMINISTRADOR'));
            $table->string('pass', 200);
            $table->enum('estado', array('ACTIVADO', 'DESACTIVADO'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('personal');
    }

}
