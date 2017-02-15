<?php

App::uses("PanelController", "Controller");

class ProductsController extends PanelController {
	public $uses = array('Product', 'ProductSpec', 'ProductSpecPic', 'ProductFeature', 'ProductPicture', 'ProductVideo', 'ProductDownload');
	
	public function index() {
		if(!empty($this->request->data['Product']['type'])) {
			$conditions = array();
			if(!empty($this->request->data['Product']['name'])) $conditions['Product.name LIKE'] = '%' . $this->request->data['Product']['name'] . '%';
			$this->paginate = array(
				'limit' => 10000000,
				'conditions' => array(
					'or' => $conditions
				),
				'order' => array(
					'Product.order' => 'ASC',
					'Product.id' => 'DESC'
				)
			);
		}
		$this->set('data', $this->paginate());
	}
	
	
	public function add_child($id) {
		$this->set('product_id', $id);
		$this->render('crud');
	}
	public function crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
						
			if($this->Product->save($this->request->data)) {
				if(!empty($_POST['delete-picture'])) {
					$file = $this->Product->field('picture');
					if(file_exists('files/' . $file) && is_file('files/' . $file)) @unlink('files/' . $file);
					$this->Product->save(array(
						'Product' => array(
							'id' => $this->Product->id,
							'picture' => ''
						)
					));
				}
				
				if(!empty($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 845, 366);
					$this->Product->save(array(
						'Product' => array(
							'id' => $this->Product->id,
							'picture' => $filename
						)
					));
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 446, 193);
					$this->Product->save(array(
						'Product' => array(
							'id' => $this->Product->id,
							'picture_thumb' => $filename
						)
					));
				}
				
				$this->ProductSpec->deleteAll(array('ProductSpec.product_id' => $this->Product->id));
				
				if(!empty($_POST['feature'])) foreach($_POST['feature'] as $feature) {
					$this->ProductSpec->create();
					$this->ProductSpec->save(array(
						'ProductSpec' => array(
							'product_id' => $this->Product->id,
							'name' => $feature['name'],
							'value' => $feature['value'],
							'value_2' => $feature['value_2']
						)
					));
				}
				
				if(!empty($_FILES['fpics'])) foreach($_FILES['fpics']['name'] as $i => $fpic) {
					$data = array(
						'name' => $_FILES['fpics']['name'][$i],
						'type' => $_FILES['fpics']['type'][$i],
						'tmp_name' => $_FILES['fpics']['tmp_name'][$i],
						'error' => $_FILES['fpics']['error'][$i], 
						'size' => $_FILES['fpics']['size'][$i]
					);
					
					$filename = $this->VNSFile->savePicture($data, 760);
					$this->ProductSpecPic->create();
					$this->ProductSpecPic->save(array(
						'ProductSpecPic' => array(
							'product_id' => $this->Product->id,
							'picture' => $filename
						)
					));
				}
				
				if(!empty($_POST['delpics'])) foreach($_POST['delpics'] as $id_del) {
					$pic = $this->ProductSpecPic->findById($id_del);
					@unlink('files/' . $pic['ProductSpecPic']['picture']);
					$this->ProductSpecPic->delete($id_del);
				}
				
				$this->Session->setFlash(__('Producto guardado con éxito.'));
				$this->redirect(array('controller' => 'products', 'action' => 'index'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Product->id = $id;
				if(!$this->Product->exists()) {
					$this->Session->setFlash(__('El producto especificado no existe'));
					$this->redirect(array('controller' => 'products', 'action' => 'index'));
				}
				
				$this->data = $this->Product->read();
				
				//var_dump($this->data);die();
			}
		}
	}
	
		
	public function delete($id) {
		$this->Product->id = $id;
		if(!$this->Product->exists()) {
			$this->Session->setFlash(__('El producto especificado no existe'));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		else {
			$title = $this->Product->field('name');
			$this->Product->delete($id);
			$this->ProductVariant->deleteAll(array('Product.product_id' => $id));
			
			$this->Session->setFlash(__('El producto «%s» fue eliminado con éxito', $title));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
	}
	
	
	
	public function features($product_id) {
		$paginate = array(
			'conditions' => array(
				'ProductFeature.product_id' => $product_id
			)
		);
		$this->set('product', $this->Product->findById($product_id));
		$this->paginate = $paginate;
		$this->set('data', $this->paginate('ProductFeature'));
	}
	
	public function feature_crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			//var_dump($_FILES);die();
			if($this->ProductFeature->save($this->request->data)) {
				if(!empty($_POST['delete-picture'])) {
					$file = $this->ProductFeature->field('picture');
					if(file_exists('files/' . $file) && is_file('files/' . $file)) @unlink('files/' . $file);
					$this->ProductFeature->save(array(
						'ProductFeature' => array(
							'id' => $this->ProductFeature->id,
							'picture' => ''
						)
					));
				}
				
				if(!empty($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 303, 207);
					$this->ProductFeature->save(array(
						'ProductFeature' => array(
							'id' => $this->ProductFeature->id,
							'picture' => $filename
						)
					));
				}
				
				$product_id = $this->request->data['ProductFeature']['product_id'];
				$this->Session->setFlash(__('Característica guardada con éxito.'));
				$this->redirect(array('controller' => 'products', 'action' => 'features', $product_id));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->ProductFeature->id = $id;
				if(!$this->ProductFeature->exists()) {
					$this->Session->setFlash(__('La característica especificada no existe'));
					$this->redirect(array('controller' => 'products', 'action' => 'index'));
				}
				$this->data = $this->ProductFeature->read();
				$this->set('product', $this->Product->findById($this->data['ProductFeature']['product_id']));
			}
			else {
				$this->set('product_id', $_GET['product_id']);
				$this->set('product', $this->Product->findById($_GET['product_id']));
			}
		}
	}
	
	
	public function feature_delete($id) {
		$this->ProductFeature->id = $id;
		if(!$this->ProductFeature->exists()) {
			$this->Session->setFlash(__('El ítem especificado no existe'));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		else {
			$title = $this->ProductFeature->field('title');
			$product_id = $this->ProductFeature->field('product_id');
			$picture = $this->ProductFeature->field('picture');
			$this->ProductFeature->delete($id);
			
			@unlink('files/' . $picture);
			
			$this->Session->setFlash(__('El ítem «%s» fue eliminado con éxito', $title));
			$this->redirect(array('controller' => 'products', 'action' => 'features', $product_id));
		}
	}
	
	
	public function gallery_index($product_id) {
		$this->set('data', $this->ProductPicture->find(
			'all',
			array(
				'conditions' => array(
					'ProductPicture.product_id' => $product_id
				),
				'order' => array('ProductPicture.order')
			)
		));
		$this->set('id', $product_id);
	}

		
	public function gallery_reorder() {
		$index = 1;
		foreach($_POST['id'] as $picture_id) {
			$this->ProductPicture->save(array(
				'ProductPicture' => array(
					'id' => $picture_id,
					'order' => $index
				)
			));
			$index++;
		}
		$this->autoRender = false;
		
	}
	
	public function gallery_picture_crud($id) {
		if($this->request->is('post') || $this->request->is('put')) {
			$this->ProductPicture->save($this->request->data);
			$this->autoRender = false;
			echo '<script>parent.$.fancybox.close();</script>';
		}
		else {
			$this->ProductPicture->id = $id;
			$this->data = $this->ProductPicture->read();
			$this->layout = 'popup';
		}
	}
	public function gallery_picture_delete() {
		$this->autoRender = false;
		
		$file_name = $this->ProductPicture->findById($_POST['id']);
		$file_big = $file_name['ProductPicture']['file_big'];
		$file_name = $file_name['ProductPicture']['file_name'];
		@unlink('files/' . $file_name);
		@unlink('files/' . $file_big);
		$file_name = $this->ProductPicture->delete($_POST['id']);
	}
	
	public function gallery_picture_new() {
		$this->autoRender = false;
		if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
			
			$pic_data_big = $this->VNSFile->savePicture($_FILES['picture'], 831);
			$pic_data = $this->VNSFile->savePicture($_FILES['picture'], 289, 193);
			
			
			$max_order = $this->ProductPicture->find(
				'first',
				array('order' => array('ProductPicture.order' => 'DESC'))
			);
			$max_order = $max_order['ProductPicture']['order'];
			$max_order++;
			
			$this->ProductPicture->create();
			$this->ProductPicture->save(array(
				'ProductPicture' => array(
					'product_id' => $_POST['product_id'],
					'file_name' => $pic_data,
					'file_big' => $pic_data_big,
					'order' => $max_order
				)
			));
		}
		$this->redirect('/products/gallery_index/' . $_POST['product_id']);
	}
	
	public function videos($product_id) {
		$paginate = array(
			'conditions' => array(
				'ProductVideo.product_id' => $product_id
			)
		);
		$this->set('product', $this->Product->findById($product_id));
		$this->paginate = $paginate;
		$this->set('data', $this->paginate('ProductVideo'));
	}
	
	public function video_crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			//var_dump($_FILES);die();
			if($this->ProductVideo->save($this->request->data)) {
				$product_id = $this->request->data['ProductVideo']['product_id'];
				$this->Session->setFlash(__('Ítem guardado con éxito.'));
				$this->redirect(array('controller' => 'products', 'action' => 'videos', $product_id));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->ProductVideo->id = $id;
				if(!$this->ProductVideo->exists()) {
					$this->Session->setFlash(__('El ítem especificado no existe'));
					$this->redirect(array('controller' => 'products', 'action' => 'index'));
				}
				$this->data = $this->ProductVideo->read();
				$this->set('product', $this->Product->findById($this->data['ProductVideo']['product_id']));
			}
			else {
				$this->set('product_id', $_GET['product_id']);
				$this->set('product', $this->Product->findById($_GET['product_id']));
			}
		}
	}
	
	
	public function video_delete($id) {
		$this->ProductVideo->id = $id;
		if(!$this->ProductVideo->exists()) {
			$this->Session->setFlash(__('El ítem especificado no existe'));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		else {
			$title = $this->ProductVideo->field('description');
			$product_id = $this->ProductVideo->field('product_id');
			$this->ProductVideo->delete($id);
			
			$this->Session->setFlash(__('El ítem fue eliminado con éxito', $title));
			$this->redirect(array('controller' => 'products', 'action' => 'videos', $product_id));
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function downloads($product_id) {
		$paginate = array(
			'conditions' => array(
				'ProductDownload.product_id' => $product_id
			)
		);
		$this->set('product', $this->Product->findById($product_id));
		$this->paginate = $paginate;
		$this->set('data', $this->paginate('ProductDownload'));
	}
	
	public function download_crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) {
				$name = $_FILES['file']['name'];
				$index = 0;
				while(file_exists('files/' . $name)) {
					$index++;
					$name = $index . '_' . $_FILES['file']['name'];
				}

				move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $name);

				$this->request->data['ProductDownload']['file_name'] = $name;
				
				if($id) {
					$old_prod = $this->ProductDownload->findById($id);
					$old_file = 'files/' . $old_prod['ProductDownload']['file_name'];
					if(file_exists($old_file) && is_file($old_file)) @unlink($old_file);
				}
			}
			
			if($this->ProductDownload->save($this->request->data)) {
				
				$this->Session->setFlash(__('Elemento guardado con éxito.'));
				$this->redirect(array('controller' => 'products', 'action' => 'downloads', $this->request->data['ProductDownload']['product_id']));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->ProductDownload->id = $id;
				if(!$this->ProductDownload->exists()) {
					$this->Session->setFlash(__('El elemento especificado no existe'));
					$this->redirect(array('controller' => 'products', 'action' => 'index'));
				}
				$this->data = $this->ProductDownload->read();
				$this->set('product', $this->Product->findById($this->data['ProductDownload']['product_id']));
			}
			else {
				$this->set('product_id', $_GET['product_id']);
				$this->set('product', $this->Product->findById($_GET['product_id']));
			}
		}
	}
	
	
	public function download_delete($id) {
		$this->ProductDownload->id = $id;
		if(!$this->ProductDownload->exists()) {
			$this->Session->setFlash(__('El elemento especificado no existe'));
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		else {
			$title = $this->ProductDownload->field('title');
			$product_id = $this->ProductDownload->field('product_id');
			//$picture = $this->ProductDownload->field('picture');
			$this->ProductDownload->delete($id);
			
			//@unlink('files/' . $picture);
			
			$this->Session->setFlash(__('El elemento «%s» fue eliminado con éxito', $title));
			$this->redirect(array('controller' => 'products', 'action' => 'downloads', $product_id));
		}
	}

	public function reorder($do = false) {
		if($do == 'do') {
			$index = 1;
			foreach($_POST['items'] as $id) {
				$this->Product->save(array(
					'Product' => array(
						'id' => $id,
						'order' => $index
					)
				));
				$index++;
			}
			die();
		}
		$items = $this->Product->find(
			'all',
			array(
				'order' => array(
					'Product.order' => 'ASC',
					'Product.id' => 'DESC'
				)
			)
		);
		$this->set(compact('items'));
	}
}

?>
