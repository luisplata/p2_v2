<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTratamientoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tratamiento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('medicamento', 45);
			$table->string('dosis', 45);
			$table->string('periocidad', 45);
			$table->string('paciente_cedula', 11)->index('fk_tratamiento_paciente1_idx');
			$table->enum('estado', array('VIGENTE','PRESCRITO'))->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tratamiento');
	}

}
