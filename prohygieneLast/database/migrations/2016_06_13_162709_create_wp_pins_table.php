<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpPinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vns_wp_pins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idCat');
			$table->string('pinName');
			$table->integer('grupo_id');
			$table->boolean('puede_inscribir');	
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
		Schema::drop('wp_pins');
	}

}
