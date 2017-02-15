<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  Schema::create('vns_periodos', function(Blueprint $table)
		{
			$table->increments('idPeriodo');
			$table->string('periodoNombre');
			$table->string('destinado');
			$table->integer('idCursoF');
			$table->string('capacitador');
			$table->date('fecha');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('periodos');
	}

}
