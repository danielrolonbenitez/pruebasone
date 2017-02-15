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


/*acceso a el panel de administracion*/
Route::get('/admin',['as'=>'login','uses'=>'AdminController@index']);
Route::post('/validaUser',['as'=>'validaUser','uses'=>'AdminController@validaUser']);


Route::get('logout',function(){

	 Auth::logout();

    return Redirect::route('login');

});


Route::group(['middleware' => 'auth'], function()
{

Route::get('/panel',['as'=>'panel','uses'=>'AdminController@panel']);
Route::post('/plantillaExcel',['as'=>'plantillaExcel','uses'=>'AdminController@plantillaExcel']);
Route::any('/curso_index',['as'=>'cursoIndex','uses'=>'AdminController@cursoindex']);
Route::any('/curso_alta',['as'=>'cursoAlta','uses'=>'AdminController@cursoalta']);
Route::any('/curso_edit/{id}',['as'=>'cursoEdit','uses'=>'AdminController@cursoedit']);
Route::get('/curso_delete/{id}',['as'=>'cursoDelete','uses'=>'AdminController@cursodelete']);


Route::get('/periodo_index',['as'=>'periodoIndex','uses'=>'AdminController@periodoindex']);
Route::any('/periodo_alta',['as'=>'periodoAlta','uses'=>'AdminController@periodoalta']);
Route::any('/periodo_edit/{id}',['as'=>'periodoEdit','uses'=>'AdminController@periodoedit']);
Route::get('/periodo_delete/{id}',['as'=>'periodoDelete','uses'=>'AdminController@periododelete']);

Route::get('/tablaWpterms_index',['as'=>'tablaWPtermsIndex','uses'=>'AdminController@tablaWPtermsindex']);
Route::get('/categoria_index',['as'=>'categoriaIndex','uses'=>'AdminController@categoriaindex']);
Route::any('/categoria_alta',['as'=>'categoriaAlta','uses'=>'AdminController@categoriaalta']);
Route::any('/categoria_edit/{id}',['as'=>'categoriaEdit','uses'=>'AdminController@categoriaedit']);
Route::get('/categoria_delete/{id}',['as'=>'categoriaDelete','uses'=>'AdminController@categoriadelete']);
Route::get('/wp_log/{id}/{name}',['as'=>'wplogDelete','uses'=>'AdminController@wplogDelete']);
Route::get('/machear_datos/{id}/{name}/{accion}',['as'=>'crossTableData','uses'=>'AdminController@crossTableData']);
Route::get('/tablelogIndex',['as'=>'tablelogIndex','uses'=>'AdminController@tablelogIndex']);
Route::get('/tablelogDelete/{id}',['as'=>'tablelogDelete','uses'=>'AdminController@logDelete']);
Route::any('usuarios_categorias_index/',['as'=>'userscategories','uses'=>'AdminController@usercategories']);



Route::get('/destinatario_index',['as'=>'destinatarioIndex','uses'=>'AdminController@destinatarioindex']);
Route::any('/destinatario_alta',['as'=>'destinatarioAlta','uses'=>'AdminController@destinatarioalta']);
Route::any('/destinatario_edit/{id}',['as'=>'destinatarioEdit','uses'=>'AdminController@destinatarioedit']);
Route::get('/destinatario_delete/{id}',['as'=>'destinatarioDelete','uses'=>'AdminController@destinatariodelete']);


Route::get('/capacitador_index',['as'=>'capacitadorIndex','uses'=>'AdminController@capacitadorindex']);
Route::any('/capacitador_alta',['as'=>'capacitadorAlta','uses'=>'AdminController@capacitadoralta']);
Route::any('/capacitador_edit/{id}',['as'=>'capacitadorEdit','uses'=>'AdminController@capacitadoredit']);
Route::get('/capacitador_delete/{id}',['as'=>'capacitadorDelete','uses'=>'AdminController@capacitadordelete']);






//Route::post('/curso_alta_store',['as'=>'cursoAltaStore','uses'=>'AdminController@cursoaltastore']);



//Route::get('/');

});

/**/






Route::get('/inscripcion',['as'=>'inscripcion','uses'=>'CursoController@inscripcion']);



//ver calendario//

Route::get('/',['as'=>'vercalendario','uses'=>'CalendarioController@index']);









//carga las fechas que le corresponde a cada curso//

Route::get('ajaxFechaCurso','CursoController@fechaCurso');

//alamacena las inscripciones//

Route::get('storeForm','CursoController@almacena');




//carga la grilla//
route::get('ajaxLoadGrilla','CursoController@loadGrilla');


//elimina de la grilla por ajax//



route::get('ajaxDeleteGrilla','CursoController@grillaDelete');


//carga todos los eventos mediante  json a el calendario//

route::get('/loadEvent','CalendarioController@cargarEvento');

route::get('/r','CalendarioController@r');



// editar grilla inscripcion//
//route::get('ajaxEditGrilla','CursoController@grillaEdit');


//completa los email de usuarios//
route::get('listUsersWp','CursoController@listUsersWp');


route::get('/prueba','CursoController@siesSoloJefe');

route::get('/prueba2','AdminController@getAnio');

route::get('/ajaxAnioPeriodo','AdminController@ajaxAnioPeriodo');

route::get('/ajaxAnioPeriodoInscripcion','CursoController@ajaxAnioPeriodoInscripcion');
route::get('/ajaxLoadCursoInscripcion','CursoController@ajaxLoadCursoInscripcion');

route::get('/ajaxYainscripto','CursoController@ajaxYainscripto');

//carga los cursos tipo campus//


route::get('/ajaxloadcursocampus','CursoController@ajaxloadcursocampus');














/*calendario*/

route::get('/ajaxAnioPeriodoCalendario','CalendarioController@ajaxAnioPeriodoCalendario');

route::get('/ajaxVerPorPantalla','AdminController@ajaxVerPorPantalla');


/*rol del que esta logueado*/

route::get('/rol','CursoController@rolUserLogin');