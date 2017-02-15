<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosRubrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('negocios_rubros', function(Blueprint $table)
		{
			$table->integer('idNegocioF');
			$table->integer('idRubroF');
			$table->timestamps();
			$table->primary(array('idNegocioF', 'idRubroF'));

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('negocios_rubros');
	}

}
