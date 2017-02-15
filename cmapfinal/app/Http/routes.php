<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

//Route::controllers([
	//'auth' => 'Auth\AuthController',
	//'password' => 'Auth\PasswordController',
//]);

/*part public page view home*/
Route::get('/', ['as'=>'homepublic','uses'=>'HomeController@index']);
Route::post('/procesaH',['as'=>'ProcesaDataHome','uses'=>'HomeController@viewNegocioMap']);
Route::any('/NegocioBusqueda',['as'=>'dataHome','uses'=>'HomeController@dataHome']);


/*carga los market en el mapa pora ajax*/

Route::get('ajaxMarkeMap','HomeController@MarkeMap');

/*end carga los market en el mapoa*/



/*load carga todos los negocios por ajax */
Route::get('ajaxLoadAllNegocios',['as'=>'ajaxLoadAllNegocios','uses'=>'HomeController@AllLoadNegocios']);

/*end carga todos los negocios por ajax*/

Route::get('/ajaxLoadFotos','HomeController@ajaxLoadFotos');


/*end part public */







/*vista y validacion pora login*/
Route::get('/login',['as'=>'login','uses'=>'LoginController@index']);
Route::post('/validaUser', [ 'as'=>'validaUser' ,'uses'=>'LoginController@validaUser']);

//begin negocio//

//verifica que el usuario este autenticado para poder ver la vista negocio
Route::group(['prefix'=>'Admin','middleware' => 'auth'], function(){

 /*begin negocio*/

 
Route::get('Negocio',['as'=>'indexNegocio','uses'=>'NegocioController@index']);
Route::get('AltaNegocio',['as'=>'negocioViewStore' ,'uses'=>'NegocioController@viewStore']);

Route::post('negocioStore',['as'=>'negocioStore','uses'=>'NegocioController@store']);
Route::get('EditarNegocio/{id}',['as'=>'negocioEdit','uses'=>'NegocioController@negocioEdit']);
Route::post('negocioEditStore',['as'=>'negocioEditStore','uses'=>'NegocioController@negocioEditStore']);
Route::get('EliminarNegocio/{id}',['as'=>'negocioDelete','uses'=>'NegocioController@deleteNegocio']);

//editar fotos de un negocio especifico//

Route::get('EditarFoto/{id}/{negocio}',['as'=>'editarFoto','uses'=>'NegocioController@editarFotos']);


Route::post('editarFotoStore/',['as'=>'editarFotoStore','uses'=>'NegocioController@editarFotoStore']);


Route::get('EditarFotoSlider/{id}/{negocio}',['as'=>'editarFotoSlider','uses'=>'NegocioController@editarFotoSlider']);
Route::post('editarFotoStoreSlider/',['as'=>'editarFotoStoreSlider','uses'=>'NegocioController@editarFotoStoreSlider']);











Route::get('EliminarFoto/{idFoto}/{idNegocio}',['as'=>'eliminarFotoNegocio','uses'=>'NegocioController@eliminarFotoNegocio']);

Route::get('AgregarFoto/{id}',['as'=>'addMorePic','uses'=>'NegocioController@addMorePic']);

Route::post('addMorePicStore/',['as'=>'addMorePicStore','uses'=>'NegocioController@addMorePicStore']);




 /*end negocio*/

/*begin rubro*/

Route::get('Rubro',['as'=>'indexRubro','uses'=>'RubroController@index']);

Route::get('AltaRubro',['as'=>'AltaRubro','uses'=>function(){return view('Rubro.createRubro');}]);
Route::post('storeRubro',['as'=>'storeRubro','uses'=>'RubroController@store']);
Route::get('EditarRubro/{id}',['as'=>'rubroEdit','uses'=>'RubroController@rubroEdit']);
Route::post('rubroEditStore',['as'=>'rubroEditStore','uses'=>'RubroController@rubroEditStore']);

Route::get('EliminarRubro/{id}',['as'=>'rubroDelete','uses'=>'RubroController@deleteRubro']);



/*end rubro*/



/*begin entidad*/
Route::get('Entidad',['as'=>'indexEntidad','uses'=>'EntidadController@index']);
Route::get('AltaEntidad',['as'=>'AltaEntidad','uses'=>function(){return view('Entidad.createEntidad');}]);
Route::post('storeEntidad',['as'=>'storeEntidad','uses'=>'EntidadController@store']);
Route::get('EditarEntidad/{id}',['as'=>'entidadEdit','uses'=>'EntidadController@entidadEdit']);
Route::post('entidadEditStore',['as'=>'entidadEditStore','uses'=>'EntidadController@entidadEditStore']);

Route::get('EliminarEntidad/{id}',['as'=>'entidadDelete','uses'=>'EntidadController@deleteEntidad']);

/*end entidad*/


/*begin usuario*/
Route::get('Usuario',['as'=>'indexUser','uses'=>'UserController@index']);
Route::get('AltaUsuario',['as'=>'AltaUsuario','uses'=>function(){return view('User.createUser');}]);
Route::post('storeUser',['as'=>'storeUser','uses'=>'UserController@store']);
Route::get('EditarUsuario/{id}',['as'=>'UserEdit','uses'=>'UserController@UserEdit']);
Route::post('UserEditStore',['as'=>'UserEditStore','uses'=>'UserController@UserEditStore']);

Route::get('EliminarUsuario{id}',['as'=>'UserDelete','uses'=>'UserController@deleteUser']);

/*end usuario*/



Route::get('admin/ajaxCiudad', function(){
$id=$_GET['valor'];
$datos=DB::table('ciudades')->where('idProvinciaF',$id)->get();
 return $datos;
});


/*begin plantilla excel*/

Route::get('/plantillaExcelDownload/{seleccionado}',['as'=>'plantillaExcelDownload','uses'=>'ExcelController@download']);


/*end plantilla excel*/













});/*end middleware*/


//devuelve por ajax la ciudad segun la provincia seleccionada//
Route::get('ajaxCiudad', function(){
$id=$_GET['valor'];
$datos=DB::table('ciudades')->where('idProvinciaF',$id)->get();
 return $datos;
});

Route::get('logout','Auth\AuthController@getLogout');


Route::get('/prueba','HomeController@AllLoadNegocios');



Route::get('/r','ResizeImagenController@index');


Route::get('/pruebaAjax','HomeController@ajaxLoadFotos');



//enviar nombre de camaras//

Route::get('/ajaxCamara','HomeController@camara');




//prueba vista//

route::get('/prueba2',function(){

$provincias=1;
$rubros=1;


	return view('includes.buscador_negocios',compact('provincias','rubros'));
});





