<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcompananteTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('acompanante', function(Blueprint $table) {
            $table->integer('cedula')->nullable();
            $table->string('nombre', 40)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->enum('sexo', array('H', 'M'))->nullable();
            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')
                    ->references('id')->on('paciente')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('acompanante');
    }

}
