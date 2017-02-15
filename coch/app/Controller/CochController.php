<?php

class CochController extends AppController {
	public $uses = array('NewsletterSubscription', 'Product', 'Article', 'Page', 'Picture', 'Video');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$product_list = $this->Product->find(
			'all',
			array(
				'order' => array(
						'Product.order' => 'ASC',
						'Product.id' => 'DESC'
				)
			)
		);
		$why_coch = $this->Page->findById(1);
		$coch_world = $this->Page->findById(2);
		$this->set('header_products', $product_list);
		$this->set(compact('why_coch', 'coch_world'));
	}
	
	public function add_newsletter() {
		//NewsletterSubscription
		$results = array();
		$exists = $this->NewsletterSubscription->findByEmail($_POST['email']);
		if($exists) $results = array(
			'status' => 'error',
			'message' => 'Ya existe una persona registrada con esa dirección de E-mail.'
		);
		else {
			$this->NewsletterSubscription->create();
			$this->NewsletterSubscription->save(array(
				'NewsletterSubscription' => array(
					'email' => $_POST['email']
				)
			));
			$results['status'] = 'ok';
		}
		echo json_encode($results);
		die();
	}
	
	public function index() {
		$featured_article = $this->Article->find(
			'first',
			array(
				'conditions' => array(
					'Article.in_home' => 1
				)
			)
		);
		$this->set(compact('featured_article'));
	}
	public function presentacion($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			//var_dump($this->Product->read());die();
			$this->set('product', $this->Product->read());
		}
	}
	public function ficha_tecnica($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			$this->set('product', $this->Product->read());
		}
	}
	public function caracteristicas($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			$this->set('product', $this->Product->read());
		}
	}
	public function p_videos($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			$this->set('product', $this->Product->read());
		}
	}
	public function p_imagenes($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			$this->set('product', $this->Product->read());
		}
	}
	public function p_descargas($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) $this->redirect('/');
		else {
			$this->set('product', $this->Product->read());
		}
	}
	
	public function articles() {
		$this->paginate = array(
			'Article' => array(
				'order' => array('Article.id', 'DESC'),
				'limit' => 6
			)
		);
		$this->set('articles', $this->paginate('Article'));
	}
	public function article($id) {
		$this->Article->id = $id;
		if(!$this->Article->exists()) $this->redirect($url);
		$article = $this->Article->read();
		$this->set('article', $article);
	}
	public function contacto($footer = false) {
		if(!empty($_POST)) {
			$result = array();
			
			if(empty($_POST['FC_c_name'])) $result = array(
				'status' => 'error',
				'message' => 'El nombre es obligatorio'
			);
			elseif(empty($footer) && empty($_POST['FC_c_company'])) $result = array(
				'status' => 'error',
				'message' => 'El nombre de la empresa es obligatorio'
			);
			elseif(empty($_POST['FC_c_email'])) $result = array(
				'status' => 'error',
				'message' => 'La dirección de e-mail es obligatoria'
			);
			elseif(!filter_var($_POST['FC_c_email'], FILTER_VALIDATE_EMAIL)) $result = array(
				'status' => 'error',
				'message' => 'La dirección de e-mail ingresada no es válida'
			);
			elseif(empty($_POST['FC_c_mensaje'])) $result = array(
				'status' => 'error',
				'message' => 'El mensaje es obligatorio'
			);
			else {
				$result['status'] = 'ok';
				
				$coch_sector = '';
				if(empty($footer)) {
					if($_POST['sector'] == 'services') $coch_sector = 'Servicios';
					elseif($_POST['sector'] == 'commercial') $coch_sector = 'Comercial';
					elseif($_POST['sector'] == 'management') $coch_sector = 'Administración';
				}
				
				if(empty($_POST['FC_c_name'])) $_POST['FC_c_name'] = '';
				if(empty($_POST['FC_c_company'])) $_POST['FC_c_company'] = '';
				if(empty($_POST['FC_c_email'])) $_POST['FC_c_email'] = '';
				if(empty($_POST['FC_c_phone'])) $_POST['FC_c_phone'] = '';
				if(empty($_POST['FC_c_mensaje'])) $_POST['FC_c_mensaje'] = '';
				
				mail(
					'nico89abc@gmail.com',
					'Nueva consuta',
					<<<END
Un visitante del sitio Coch ha enviado una consulta:

 - Nombre: {$_POST['FC_c_name']}
 - Empresa: {$_POST['FC_c_company']}
 - E-Mail: {$_POST['FC_c_email']}
 - Teléfono: {$_POST['FC_c_phone']}
 - Sector: $coch_sector
 - Mensaje: {$_POST['FC_c_mensaje']}
END
					,"Header: text/plain;charset=UTF-8\r\nFrom: Sitio Web Coch <noreply@coch.com.ar>"
				);
			}
			
			echo json_encode($result);
			die();
		}
	}
	
	public function page($index) {
		$this->set('page', $this->Page->findById($index));
	}
	
	public function imagenes() {
		$this->set('pictures', $this->Picture->find('all', array(
			'order' => array('Picture.order' => 'ASC')
		)));
	}
	public function videos() {
		$this->set('videos', $this->Video->find('all'));
	}
}