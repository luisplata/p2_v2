<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSignosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->float('pulso', 10, 0);
			$table->float('so', 10, 0);
			$table->dateTime('fecha_signo');
			$table->string('paciente_cedula', 11)->index('fk_signos_paciente1_idx');
			$table->integer('cubiculo')->nullable();
			$table->boolean('lectura')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signos');
	}

}
