<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notas', function(Blueprint $table) {
            $table->integer('id', true);
            $table->string('notas', 45)->nullable();
            $table->integer('personal_id')->unsigned();
            $table->integer('historia_clinica_id')->unsigned();

            $table->foreign('historia_clinica_id')->references('id')->on('historia_clinica')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('notas');
    }

}
