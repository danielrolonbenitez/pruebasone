<?php

class AdmController extends AppController {
	public $uses = array('Gallery', 'Article', 'Category', 'BusinessType', 'NewsletterSubscription', 'Product');
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Category->unbindModel(array('belongsTo' => array('Parent')));
		$this->Category->recursive = 4;
		$categories = $this->Category->find('all', array('conditions' => array('Category.category_id' => NULL)));
		$this->set(compact('categories'));
		
		
		$client = $this->Session->read('login_client');
		if($client) $this->set(compact('client'));
		
	}
	
	public function index() {
		$gallery = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => 1)));
		$featured_article = $this->Article->find(
			'first',
			array(
				'conditions' => array(
					'Article.in_home' => 1
				)
			)
		);

		$this->set(compact('gallery', 'featured_article'));
	}
	public function contacto() {
		if(!empty($_POST)) {
			$result = array();
			
			if(empty($_POST['name'])) $result = array(
				'status' => 'error',
				'message' => 'El nombre es obligatorio'
			);
			elseif(empty($_POST['email'])) $result = array(
				'status' => 'error',
				'message' => 'La dirección de e-mail es obligatoria'
			);
			elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $result = array(
				'status' => 'error',
				'message' => 'La dirección de e-mail ingresada no es válida'
			);
			elseif(empty($_POST['message'])) $result = array(
				'status' => 'error',
				'message' => 'El mensaje es obligatorio'
			);
			else {
				$result['status'] = 'ok';
				
				$this->BusinessType->id = $_POST['business_type'];
				$business_type = $this->BusinessType->field('name');
				
				mail(
					'nico89abc@gmail.com',
					'Nueva consuta',
					<<<END
Un visitante del sitio ADM Web ha enviado una consulta:

 - Nombre: {$_POST['name']}
 - Empresa: {$_POST['company']}
 - E-Mail: {$_POST['email']}
 - Teléfono: {$_POST['phone']}
 - Tipo de negocio: $business_type
 - Mensaje: {$_POST['message']}
END
					,"Header: text/plain;charset=UTF-8\r\nFrom: Sitio Web ADM Group <noreply@admelectricos.com.ar>"
				);
			}
			
			echo json_encode($result);
			die();
		}
		$business = $this->BusinessType->find('all');
		$this->set(compact('business'));
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
	
	public function productos($categoria_slug) {
		$id_categoria = array();
		$is_valid_slug = preg_match('/-([0-9]+)\.html/', $categoria_slug, $id_categoria);
		
		if($is_valid_slug) {
			$id_categoria = $id_categoria[1];
			
			$category_list = array($id_categoria);
			$final_list = array($id_categoria);
			
			while(count($category_list) != 0) {
				$curr_cat = $category_list[0];
				
				$children = $this->Category->find(
					'all',
					array('conditions' => array(
						'Category.category_id' => $curr_cat
					))
				);
				foreach($children as $child) {
					$category_list []= $child['Category']['id'];
					$final_list []= $child['Category']['id'];
				}
				
				array_shift($category_list);
			}
			
			/*$products = $this->Product->find(
				'all',
				array(
					'conditions' => array(
						'Product.category_id' => $final_list
					)
				)
			);*/
			$this->set(compact('products'));
			//var_dump($products);die();
			
			$this->Category->recursive = -1;
			$l_index = 0;
			$breadcrumbs = array(
				$this->Category->findById($id_categoria)
			);
			while($breadcrumbs[$l_index]['Category']['category_id'] != NULL) {
				$parent = $breadcrumbs[$l_index]['Category']['category_id'];
				$l_index++;
				$breadcrumbs[$l_index] = $this->Category->findById($parent);	
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			//var_dump($breadcrumbs);die();
			$category = $this->Category->findById($id_categoria);
			$this->set(compact('breadcrumbs', 'category'));
			
			$this->paginate = array(
				'Product' => array(
					'limit' => 3,
					'conditions' => array(
						'Product.category_id' => $final_list
					)
				)
			);
			$this->set('data', $this->paginate('Product'));
			
		}
		else $this->redirect('/');
	}
	
	public function producto($slug) {
		$id_producto = array();
		$is_valid_slug = preg_match('/-([0-9]+)\.html/', $slug, $id_producto);
		
		if($is_valid_slug) {
			$id_producto = $id_producto[1];
			
			$product = $this->Product->findById($id_producto);
			
			$l_index = 0;
			$breadcrumbs = array(
				$this->Category->findById($product['Product']['category_id'])
			);
			while($breadcrumbs[$l_index]['Category']['category_id'] != NULL) {
				$parent = $breadcrumbs[$l_index]['Category']['category_id'];
				$l_index++;
				$breadcrumbs[$l_index] = $this->Category->findById($parent);	
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			
			$this->set(compact('product', 'breadcrumbs'));
		}
		else $this->redirect('/');
	}
	
	public function empresa() {}
	public function ofertas() {
		$this->paginate = array(
			'Product' => array(
				'limit' => 3,
				'conditions' => array(
					'Product.is_offer' => 1
				)
			)
		);
		$this->set('data', $this->paginate('Product'));
	}
	public function novedades($slug = null) {
		if($slug) {
			$id_noticia = array();
			$is_valid_slug = preg_match('/-([0-9]+)\.html/', $slug, $id_producto);

			if($is_valid_slug) {
				$id_noticia = $id_noticia[1];
				$this->Article->id = $id_noticia;
				if(!$this->Article->exists()) $this->redirect('/');
				else {
					$this->set('article', $this->Article->read());
					$this->render('novedades_item');
				}
			}
			else $this->redirect('/');
		}
		else {
			$this->paginate = array(
				'Article' => array(
					'limit' => 5,
					//'conditions' => array('Article.published' => 1),
					'order' => array('Article.created' => 'DESC')
				)
			);
			$this->set('data', $this->paginate('Article'));
		}
	}
	public function popup_contacto() {
		$this->layout = 'ajax';
	}
}