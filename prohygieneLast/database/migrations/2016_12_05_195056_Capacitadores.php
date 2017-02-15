<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Capacitadores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('vns_capacitador', function(Blueprint $table)
		{
			$table->increments('idCapacitador');
			$table->string('nombre');
			$table->timestamps();
		});
	}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vns_capacitador');
	}

}
