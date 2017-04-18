<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('notas', 45)->nullable();
			$table->integer('personal_cedula')->index('fk_notas_personal1_idx');
			$table->integer('historia_clinica_id')->index('fk_notas_historia_clinica1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notas');
	}

}
