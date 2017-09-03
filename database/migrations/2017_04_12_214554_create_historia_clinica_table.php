<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoriaClinicaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('historia_clinica', function(Blueprint $table) {
            $table->integer('paciente_id')->unsigned();
            $table->string('historia', 45)->nullable();
            $table->increments('id');
            $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('historia_clinica');
    }

}
