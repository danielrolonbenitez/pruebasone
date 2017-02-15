<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		

		Schema::create('negocios', function(Blueprint $table)
		{
			$table->increments('idNegocio');
			$table->string('razonSocial');
			$table->string('direccion');
			$table->double('latitud');
			$table->double('longitud');
			$table->string('sitioWeb');
			$table->integer('telefono');
			$table->boolean('estado')->nullable();
			$table->integer('idEntidadF');
			$table->integer('idProvinciaF');
			$table->integer('idCiudadF');
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
	   Schema::drop('negocios');
	}

}
