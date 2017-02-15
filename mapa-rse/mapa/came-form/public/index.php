<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rb.php';
date_default_timezone_set('UTC');
R::setup( 'mysql:host=localhost;dbname=dev03_camemap',
        'root', '987654321' );
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
	   //var_dump(strpos($_SERVER['REQUEST_URI'], "/login")).die('a');
	   
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
$app->map('/login',$authenticateForRole, function () use ($app) {

    if ( $app->request()->isPost() ) {
        //If valid login, set auth cookie and redirect
		$post = (object)$app->request()->post();
		if(isset($post->user) && isset($post->password))
		{
			$user = (object) $app->validateUser($post->user,$post->password);
			if(is_object($user)){
				$app->session->put('current_user', [$user->id_usuario,$user->nombre,$user->usuario,base64_encode($user->clave),$user->nivel,$user->email]);
				$app->session->flash('message', 'logged in.');
				if($user->nivel==1){
					$app->redirect('admin');
				}else{
					$app->redirect($app->urlFor('form.id',array("identidad"=>$user->usuario)));
				}
			}
		}		
    }
    $app->render('login.php');
})->via('GET', 'POST')->name('login');

$app->map('/logout', function () use ($app) {
    $app->session->forget('current_user');
	$app->session->forget('urlRedirectBack');
    $app->session->flash('message', 'logged out.');
    $app->response->redirect('/login');
})->via('GET','DELETE');

$app->get('/',function() use ($app)
{
	$app->redirect($app->urlFor('form.id'));

})->name('root');

$app->get('/form/:identidad',function ($identidad) use ($app) {
	$app->render('form.php',array('identificacion'=>$identidad,'actionUrl'=>$app->urlFor('form.id.post'),'baseUrl'=>$app->urlFor('root')));
})->name('form.id');

$app->get('/form/:identidad/:id', $authenticateForRole(),function ($identidad,$id) use ($app){
	$sql = sprintf('SELECT actividades.*,usuarios.nombre,usuarios.email,usuarios.usuario,usuarios.id_usuario FROM actividades INNER JOIN usuarios ON (usuarios.usuario = actividades.username) WHERE actividades.username LIKE "%s" AND actividades.id = %d',$identidad,$id);
	$actividad = R::getRow($sql);
	$app->render('form-edit.php',array('identificacion'=>$identidad,'data'=>$actividad,'id'=>$id,'actionUrl'=>$app->urlFor('form.id.post'),'baseUrl'=>$app->urlFor('root')));
})->name('form.identidad.id');

$app->post('/upload/',function () use ($app) {
	$post=(object)$app->request()->post();
	$sql='';
	$actividades = R::dispense( 'actividades' );
	if($cnt=count($_FILES['image']['name'])>0&&(!empty($_FILES['image'][0]['name']))){
		$files=$_FILES['image'];
		for($i = 0 ; $i < $cnt ; $i++) {
			if ($files['error'][$i] === 0) {
				$name = uniqid('img-'.date('Ymd').'-');
				if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $name) === true) {
					$imgs[] = array('url' => '/uploads/' . $name, 'name' => $files['name'][$i]);
				}
			}
		}
		if(count($imgs)>0){
			foreach($imgs as $img){
				$array[]=$img['url'];
			}
			$array=implode(',',$array);
			$actividades->images_location = $array;
			$app->session->flash('fileMessage', 'Imagenes Subidas.');
		}else{
			$app->session->flash('fileMessage', 'Imagenes NO Subidas.');
		}
		
		
	}
	if($post->id):
		$actividades->id=$post->id;
		$actividades->status=0;
	endif;
	$actividades->username = $post->identidad;
	$actividades->categoria = $post->categoria;
	$actividades->nombreActividad = $post->nombre_actividad;
	$actividades->fecha =$post->fecha;
	$actividades->hora =$post->hora;
	$actividades->lugar =$post->lugar;
	$actividades->textoCorto =$post->texto_corto;
	$actividades->textoLargo =$post->texto_largo;
	$actividades->sitioWeb =$post->sitio_web;
	$actividades->notas =$post->notas;
	$actividades->cantidadAsistentes =$post->cantidad_asistentes;
	$actividades->informacion_reservada = $post->informacion_reservada;
	$id = R::store($actividades);
	$app->redirect($app->urlFor('form.id',array("identidad"=>$actividades->username)));
})->name('form.id.post');

$app->get('/admin', $authenticateForRole(),$notAdminRedirect(), function () use ($app) {
		$actividades = R::getAll('SELECT actividades.*,usuarios.nombre,usuarios.email,usuarios.usuario,usuarios.id_usuario FROM actividades INNER JOIN usuarios ON (usuarios.usuario = actividades.username) WHERE actividades.actividades_status = 0');
		$app->render('admin.php',array('data'=>$actividades));
})->name('admin');

$app->get('/admin/page/:id', $authenticateForRole(),$notAdminRedirect(), function () use ($app) {
		$actividades = R::getAll('SELECT actividades.*,usuarios.nombre,usuarios.email,usuarios.usuario,usuarios.id_usuario FROM actividades INNER JOIN usuarios ON (usuarios.usuario = actividades.username)');
		$app->render('admin.php',array('data'=>$actividades));
})->name('admin.get.pagination');

$app->post('/form/rechazar/:identidad/:id',function ($identidad,$id) use ($app) {
	if($app->request->isAjax()){
		$post=(object)$app->request()->post();
		$actividades = R::dispense( 'actividades' );
		$actividades->actividades_status=2;
		$actividades->id=$post->id;
		$id=R::store($actividades);
		$link = R::dispense( 'actividades_links_rechazadas' );
		$links->link_rechazada=$app->urlFor('form.identidad.id',array("identidad"=>$post->identidad,"id"=>$post->id));
		$links->id_actividad=$post->id;
		R::store($links);
		print_r($app->request()->post());
	}
})->name('form.rechazar');

$app->post('/form/aprobar/:identidad/:id',function ($identidad,$id) use ($app) {
	if($app->request->isAjax()){
		$post=(object)$app->request()->post();
		$actividades = R::dispense( 'actividades' );
		$actividades->actividades_status=1;
		$actividades->id=$post->id;
		R::store($actividades);
		print_r($app->request()->post());
	}
})->name('form.aprobar');


$app->run();