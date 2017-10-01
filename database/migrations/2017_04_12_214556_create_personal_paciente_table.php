<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonalPacienteTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personal_paciente', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('personal_id',20)->unsigned();
            $table->integer('paciente_id', 11)->unsigned();
            $table->dateTime('fecha_ingreso')->nullable();
            $table->dateTime('fecha_salida')->nullable();
            $table->primary(['id', 'personal_cedula', 'personal_id']);
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('personal_paciente');
    }

}
