<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCubiculoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cubiculo', function(Blueprint $table)
		{
			$table->foreign('paciente_cedula', 'fk_cubiculo_paciente1')->references('cedula')->on('paciente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cubiculo', function(Blueprint $table)
		{
			$table->dropForeign('fk_cubiculo_paciente1');
		});
	}

}
