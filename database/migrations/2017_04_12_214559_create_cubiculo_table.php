<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCubiculoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cubiculo', function(Blueprint $table)
		{
			$table->integer('numero')->unique('numero_UNIQUE');
			$table->string('paciente_cedula', 11)->index('fk_cubiculo_paciente1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cubiculo');
	}

}
