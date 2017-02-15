<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosInscriptosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			


			Schema::create('vns_cursos_inscriptos', function(Blueprint $table)
		{
			$table->increments('idCursoInscripto');
			$table->string('idPeriodoF');
			$table->string('periodoNombre');
			$table->integer('idFacilitador');
			$table->string('nombreFacilitador');
			$table->integer('idUserInscripto');
			$table->string('email');
			$table->string('rol');
			$table->string('city');
			$table->string('country');
			$table->string('skype');
			$table->date('fechains');
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
		Schema::drop('cursos_inscriptos');

	}

}
