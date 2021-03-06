<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rubros extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rubros', function(Blueprint $table)
		{
			$table->increments('idRubro');
			$table->string('nombre')->unique();
			$table->string('color');
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
		Schema::drop('rubros');
	}

}
