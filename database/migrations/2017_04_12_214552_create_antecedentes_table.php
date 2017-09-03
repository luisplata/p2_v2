<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAntecedentesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('antecedentes', function(Blueprint $table) {
            $table->integer('id', true);
            $table->enum('tipo', array('QUIRURGICO', 'NO_QUIRURGICOS'));
            $table->integer('paciente_id')->unsigned();
            $table->string('nombre_proce', 45)->nullable();
            $table->string('alergias', 100)->nullable();
            $table->string('ant_familiares', 45)->nullable();
            $table->string('ant_personales', 45)->nullable();
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('antecedentes');
    }

}
