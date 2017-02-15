<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rb.php';
date_default_timezone_set('UTC');
R::setup( 'mysql:host=localhost;dbname=redcame_mapa',
        'redcame_mapa', 'E4116A' );
/**
 * For IDE auto completions
 *
 * @property \Illuminate\Session\Store $session
 */
class MySlim extends \Slim\Slim {

	public function validateUser($user,$pass){
				$array = R::getRow('SELECT * FROM usuarios WHERE usuario LIKE ? LIMIT 1',array('%'.$user.'%'));
				if((strcmp($pass,$array['clave'])==0)&&(strcmp($user,$array['usuario'])==0)){
					return $array;
				}else{
					return false;
				}
	}
}
//R::debug( TRUE );
$app = new MySlim(array(
    // cookie encryption (strongly recommend)
    'cookies.encrypt' => true,
    'cookies.secret_key' => 'VNS2015',
    // session config
    'sessions.driver' => 'file', // or database
    'sessions.files' => __DIR__ . '/sessions', // require mkdir
    //'sessions.table' => 'sessions', // require create table
));

$app->config(array(
    'templates.path' => __DIR__ .'/templates',
));

$manager = new \Slim\Middleware\SessionManager($app);
$manager->setFilesystem(new \Illuminate\Filesystem\Filesystem());
// or sessions.driver == 'database'
// ... setup Eloquent ...
// $manager->setDbConnection(Eloquent::getConnection());
$session = new \Slim\Middleware\Session($manager);

$app->add($session);

$authenticateForRole = function () {
    return function () {
		$app=MySlim::getInstance();
       $current_user = $app->session->get('current_user');
		   if(!is_null($app->session->get('urlRedirectBack'))){
						 $redirectBack = $app->session->get('urlRedirectBack');
						 $app->redirect($redirectBack[0]);
			}else{
				
				if(is_null($current_user)){
					
					$app->redirect($app->urlFor('login'));			
				}
				
			}
    };
};
$notAdminRedirect= function(){
	return function(){
		$app=MySlim::getInstance();
		$current_user = $app->session->get('current_user');
		if(!$current_user[4]==1){
			$app->redirect($app->urlFor('form.id',array('identidad'=>$current_user[2])));	
		}
	};
};
$app->map('/login', function () use ($app) {

    if ( $app->request()->isPost() ) {
        //If valid login, set auth cookie and redirect
		$post = (object)$app->request()->post();
		if(isset($post->user) && isset($post->password))
		{
			$user =  $app->validateUser($post->user,$post->password);
			if($user):
				$user = (object)$user;
				if(is_object($user)){
					$app->session->put('current_user', [$user->id_usuario,$user->nombre,$user->usuario,base64_encode($user->clave),$user->nivel,$user->email]);
					$app->session->flash('message', 'logged in.');
					if($user->nivel==1){
						$app->redirect('admin');
					}else{
						$app->redirect($app->urlFor('form.id',array("identidad"=>$user->usuario)));
					}
				}
			endif;
		}		
    }
    $app->render('login.php');
})->via('GET', 'POST')->name('login');

$app->map('/logout', function () use ($app) {
    $app->session->forget('current_user');
	$app->session->forget('urlRedirectBack');
    $app->session->flash('message', 'logged out.');
    $app->response->redirect('login');
})->via('GET','DELETE');

$app->get('/',function() use ($app)
{
	$app->redirect($app->urlFor('form.id'));

})->name('root');
$app->post('/autocomplete/camara-federacion',function () use ($app) {
	$post=(object) $app->request()->post();
	$busqueda=array();
	$busquedaCamaras=R::getAll('SELECT camaras.cam_nombre,camaras.cam_abreviacion,camaras.id_camara FROM camaras WHERE camaras.cam_nombre LIKE :term OR camaras.cam_abreviacion LIKE :term',
	  array(':term' => '%'.utf8_encode($post->term).'%' )
	);
	$busquedaFederaciones=R::getAll('SELECT federaciones.fed_nombre,federaciones.fed_abreviacion,federaciones.id_federacion FROM federaciones WHERE federaciones.fed_nombre LIKE :term OR federaciones.fed_abreviacion LIKE :term',
	  array(':term' => '%'.utf8_encode($post->term).'%' )
	);
	if(is_array($busquedaCamaras) && count($busquedaCamaras)>0){
		foreach($busquedaCamaras as $busquedaCamara){
			$busqueda[]= utf8_decode($busquedaCamara['cam_abreviacion'].' - '.$busquedaCamara['cam_nombre'].' - '.$busquedaCamara['id_camara'].' - Camara');
		}
	}
	if(is_array($busquedaFederaciones) && count($busquedaFederaciones)>0){
		foreach($busquedaFederaciones as $busquedaFederacion){
			$busqueda[]= utf8_decode($busquedaFederacion['fed_abreviacion'].' - '.$busquedaFederacion['fed_nombre'].' - '.$busquedaFederacion['id_federacion'].' - Federacion');
		}
	}
	$response = $app->response();
	$response['Content-Type'] = 'application/json';
	$response['X-Powered-By'] = 'VNS';
	$response->status(200);
	$response->body(json_encode($busqueda));
})->name('form.autocomplete');

$app->get('/form',function () use ($app) {
	$app->render('form.php',array('actionUrl'=>$app->urlFor('form.id.post'),'baseUrl'=>$app->urlFor('root')));
})->name('form.id');
$app->get('/gracias',function () use ($app) {
	$app->render('gracias.php',array('actionUrl'=>$app->urlFor('form.id.post'),'baseUrl'=>$app->urlFor('root')));
})->name('gracias');

$app->get('/form/:id', $authenticateForRole(),function ($id) use ($app){
	$sql = sprintf('SELECT * FROM actividades WHERE actividades.id = "%d"',$id);
	$actividad = R::getRow($sql);
	$app->render('form-edit.php',array('data'=>$actividad,'id'=>$id,'actionUrl'=>$app->urlFor('form.id.post'),'baseUrl'=>$app->urlFor('root')));
})->name('form.identidad.id');
$app->post('/form/actualizar',function () use ($app) {

	$post=(object)$app->request()->post();
	
	$sql = sprintf('UPDATE actividades SET  identidad="%s", id_identidad="%d",is_camara="%d"
		WHERE id_actividad ="%d"', $post->identidad,$post->id_identidad,$post->is_camara,$post->id_actividad);
	if(R::exec($sql)) return true;
	return false;
	
})->name('actividad.actualizar');
$app->post('/upload/',function () use ($app) {
	$post=(object)$app->request()->post();
	$sql='';$images_location='';
	$actividades = R::dispense( 'actividades' );
	//die(var_dump($_FILES['image']['name'])); //[0] => 098 - Copy.jpg [1] => 098 - Copy (3).jpg [2] => 098 - Copy (2).jpg
	//die(var_dump()); //[0] => 098 - Copy.jpg [1] => 098 - Copy (3).jpg [2] => 098 - Copy (2).jpg
	$cnt=count($_FILES['image']['name'],1);
	if($cnt>0){
		$files=$_FILES['image'];
		for($i = 0 ; $i < $cnt ; $i++) {
			if ($files['error'][$i] == 0) {
				$name = $files['name'][$i];
				if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $name) == true) {
					$imgs[] = array('url' => '/mapa/came-form/uploads/' . $name, 'name' => $files['name'][$i]);
				}
			}
		}
		
		if(count($imgs,1)>0){
			foreach($imgs as $img){
				$array[]=$img['url'];
			}
			$array=implode(',',$array);
			$images_location = $array;
			$app->flash('fileMessage', 'Imagenes Subidas.');
			$imagenesEnviadas = true;
		}else{
			$imagenesEnviadas = false;
			}
	}
	if(strlen($post->identidad)>0){
		$identidad=explode('-',$post->identidad);
		if(strcasecmp(ltrim(end($identidad)),'Federacion')==0):
			$is_camara = 0;
		else:
			$is_camara = 1;
		endif;
		foreach($post as $k =>$v){
			$post->$k = addslashes($v);
		}
		$sql = sprintf('INSERT INTO actividades (actividades_status,imagenes_location,identidad,id_identidad,is_camara,categoria,nombre_actividad,fecha,hora,lugar,texto_corto,texto_largo,sitio_web,notas,cantidad_asistentes,informacion_reservada)
			VALUES ("%d","%s","%s","%d","%d","%d","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',0,$images_location,$identidad[1],$identidad[2],$is_camara,$post->categoria,$post->nombre_actividad,$post->fecha,$post->hora,$post->lugar,$post->texto_corto,$post->texto_largo,$post->sitio_web,$post->notas,$post->cantidad_asistentes,$post->informacion_reservada);
		if(isset($post->id)):
			$actividades->id=$post->id;
			$actividades->status=0;
			$sql = sprintf('UPDATE actividades SET actividades_status="%d", imagenes_location="%s", identidad="%s", id_identidad="%d",is_camara="%d",categoria="%d",nombre_actividad="%s",fecha="%s",hora="%s",lugar="%s",texto_corto="%s",texto_largo="%s",sitio_web="%s",notas="%s",cantidad_asistentes="%s" ,informacion_reservada="%s"
				WHERE id_actividad ="%d"',0,$images_location,$identidad[1],$identidad[2],$is_camara,$post->categoria,$post->nombre_actividad,$post->fecha,$post->hora,$post->lugar,$post->texto_corto,$post->texto_largo,$post->sitio_web,$post->notas,$post->cantidad_asistentes,$post->informacion_reservada,$post->id);
		endif;
	}else{
		$sql = sprintf('INSERT INTO actividades (actividades_status,imagenes_location,identidad,id_identidad,is_camara,categoria,nombre_actividad,fecha,hora,lugar,texto_corto,texto_largo,sitio_web,notas,cantidad_asistentes,informacion_reservada)
				VALUES ("%d","%s","%s","%d","%d","%d","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',0,$images_location,'',0,0,$post->categoria,$post->nombre_actividad,$post->fecha,$post->hora,$post->lugar,$post->texto_corto,$post->texto_largo,$post->sitio_web,$post->notas,$post->cantidad_asistentes,$post->informacion_reservada);
			if(isset($post->id)):
				$actividades->id=$post->id;
				$actividades->status=0;
				$sql = sprintf('UPDATE actividades SET actividades_status="%d", imagenes_location="%s", identidad="%s", id_identidad="%d",is_camara="%d",categoria="%d",nombre_actividad="%s",fecha="%s",hora="%s",lugar="%s",texto_corto="%s",texto_largo="%s",sitio_web="%s",notas="%s",cantidad_asistentes="%s" ,informacion_reservada="%s"
					WHERE id_actividad ="%d"',0,$images_location,'',0,$is_camara,$post->categoria,$post->nombre_actividad,$post->fecha,$post->hora,$post->lugar,$post->texto_corto,$post->texto_largo,$post->sitio_web,$post->notas,$post->cantidad_asistentes,$post->informacion_reservada,$post->id);
			endif;
	}
	R::exec($sql);
	if($imagenesEnviadas){


	$app->flash('message', 'Informacion enviada, puede cargar otra actividad si lo desea');
	}
	else {
			$app->flash('message', 'Su informacion ha sido recibida, sin emabargo las imagenes no han podido ser procesadas, verifique haberlas enviado y que no superen los 5MB');
	
	}
	$app->redirect($app->urlFor('gracias'));
})->name('form.id.post');

$app->get('/admin', $authenticateForRole(),$notAdminRedirect(), function () use ($app) {
		$actividades = R::getAll('SELECT * FROM actividades WHERE actividades_status = 0');
		$app->render('admin.php',array('data'=>$actividades));
})->name('admin');

$app->get('/admin/page/:id', $authenticateForRole(),$notAdminRedirect(), function () use ($app) {
		$actividades = R::getAll('SELECT actividades.*,usuarios.nombre,usuarios.email,usuarios.usuario,usuarios.id_usuario FROM actividades INNER JOIN usuarios ON (usuarios.usuario = actividades.username)');
		$app->render('admin.php',array('data'=>$actividades));
})->name('admin.get.pagination');

$app->post('/form/rechazar/',function () use ($app) {
	if($app->request->isAjax()){
		$post=(object)$app->request()->post();
		$sql = sprintf('UPDATE actividades SET actividades_status=2 WHERE id_actividad ='.$post->id);
		$id=R::exec($sql);
		$sql = sprintf('INSERT INTO actividades_links_rechazadas (link_rechazada,id_actividad) VALUES ("%s","%d")',$app->urlFor('form.identidad.id',array("id"=>$post->id)),$post->id);
		$id=R::exec($sql);
		print_r($app->request()->post());
	}
})->name('form.rechazar');

$app->post('/form/aprobar/',function () use ($app) {
	if($app->request->isAjax()){
		$id_federacion=0;
		$id_camara=0;
		$post=(object)$app->request()->post();
		$actividades  = R::getRow("select * from actividades where id_actividad =".$post->id);
		$actividades  = (object)$actividades;
		if($actividades->is_camara<1){
			$id_federacion=$actividades->id_identidad;
		}else{
			$id_camara=$actividades->id_identidad;
		}
		
		
		$sql = sprintf('INSERT INTO eventos (id_federacion,id_camara,id_categoria,titulo,desc_corta,desc_larga,fecha,hora,lugar,link,img,nota) VALUES ("%d","%d","%d","%s","%s","%s","%s","%s","%s","%s","%s","%s")',$id_federacion,$id_camara,$actividades->categoria,addslashes($actividades->nombre_actividad),addslashes($actividades->texto_corto),addslashes($actividades->texto_largo),$actividades->fecha,$actividades->hora,$actividades->lugar,$actividades->sitio_web,$actividades->imagenes_location,addslashes($actividades->notas));
		$id=R::exec($sql);
		
		$sql = sprintf('UPDATE actividades SET actividades_status=1 WHERE id_actividad ='.$post->id);
		$id=R::exec($sql);
		
		$sql = sprintf('DELETE FROM actividades WHERE id_actividad ='.$post->id);
		$id=R::exec($sql);
		
		print_r($app->request()->post());
	}
})->name('form.aprobar');


$app->run();