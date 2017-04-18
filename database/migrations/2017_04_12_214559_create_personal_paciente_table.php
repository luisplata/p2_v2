<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonalPacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal_paciente', function(Blueprint $table)
		{
			$table->string('id', 45)->unique('personal_has_pacientecol_UNIQUE');
			$table->integer('personal_cedula')->index('fk_personal_has_paciente_personal_idx');
			$table->string('paciente_cedula', 11)->index('fk_personal_has_paciente_paciente1_idx');
			$table->dateTime('fecha_ingreso');
			$table->dateTime('fecha_salida');
			$table->primary(['id','personal_cedula','paciente_cedula']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personal_paciente');
	}

}
