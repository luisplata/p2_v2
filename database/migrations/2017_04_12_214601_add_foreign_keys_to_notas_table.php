<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNotasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notas', function(Blueprint $table)
		{
			$table->foreign('historia_clinica_id', 'fk_notas_historia_clinica1')->references('id')->on('historia_clinica')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('personal_cedula', 'fk_notas_personal1')->references('cedula')->on('personal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notas', function(Blueprint $table)
		{
			$table->dropForeign('fk_notas_historia_clinica1');
			$table->dropForeign('fk_notas_personal1');
		});
	}

}
