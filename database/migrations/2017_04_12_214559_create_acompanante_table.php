<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcompananteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acompanante', function(Blueprint $table)
		{
			$table->integer('cedula')->unique('cedula_UNIQUE');
			$table->string('nombre', 40);
			$table->string('direccion', 100);
			$table->string('telefono', 15);
			$table->enum('sexo', array('H','M'));
			$table->string('paciente_cedula', 11)->index('fk_acompanante_paciente1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acompanante');
	}

}
