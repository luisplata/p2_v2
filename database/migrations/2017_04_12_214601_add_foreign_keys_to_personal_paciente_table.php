<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPersonalPacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('personal_paciente', function(Blueprint $table)
		{
			$table->foreign('paciente_cedula', 'fk_personal_has_paciente_paciente1')->references('cedula')->on('paciente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('personal_cedula', 'fk_personal_has_paciente_personal')->references('cedula')->on('personal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('personal_paciente', function(Blueprint $table)
		{
			$table->dropForeign('fk_personal_has_paciente_paciente1');
			$table->dropForeign('fk_personal_has_paciente_personal');
		});
	}

}
