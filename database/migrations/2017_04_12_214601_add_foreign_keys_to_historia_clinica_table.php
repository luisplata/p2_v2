<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHistoriaClinicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historia_clinica', function(Blueprint $table)
		{
			$table->foreign('paciente_cedula', 'fk_historia clinica_paciente1')->references('cedula')->on('paciente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('historia_clinica', function(Blueprint $table)
		{
			$table->dropForeign('fk_historia clinica_paciente1');
		});
	}

}
