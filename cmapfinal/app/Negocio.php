<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model {

	protected $table = 'negocios';

protected $fillable = ['razonSocial', 'direccion', 'provincia','ciudad','sitioWeb','telefono','rubro','entidad','estado','latitud','longitud','fotos','fotosSlider'];





}
