<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoriaClinicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historia_clinica', function(Blueprint $table)
		{
			$table->string('paciente_cedula', 11)->index('fk_historiaclinica_paciente1_idx');
			$table->string('historia', 45)->nullable();
			$table->integer('id')->primary();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('historia_clinica');
	}

}
