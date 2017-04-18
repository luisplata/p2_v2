<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paciente', function(Blueprint $table)
		{
			$table->string('cedula', 15)->unique('cedula_UNIQUE');
			$table->string('nombre', 40);
			$table->string('telefono', 20)->unique('celular_UNIQUE');
			$table->string('direccion', 100);
			$table->enum('sexo', array('H','M'));
			$table->enum('tipo_sangre', array('O','B','AB','A'))->nullable();
			$table->enum('RH', array('+','-'))->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paciente');
	}

}
