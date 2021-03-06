<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratamientoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tratamiento', function(Blueprint $table) {
            $table->integer('id', true);
            $table->string('medicamento', 45);
            $table->string('dosis', 45);
            $table->string('periocidad', 45);
            $table->integer('paciente_id', 11)->unsigned();
            $table->enum('estado', array('VIGENTE', 'PRESCRITO'))->nullable();
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tratamiento');
    }

}
