<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VnsLopWpTerms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{ 
	    Schema::create('vns_log_wp_terms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_terms');
			$table->string('name_log');
			$table->string('accion');
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
	  Schema::drop('vns_log_wp_terms');
	}

}
