<?php

App::uses("PanelController", "Controller");

class GalleriesController extends PanelController {
	public $uses = array('Gallery', 'GalleryPicture');
	
	public function index() {
		$this->set('data', $this->paginate());
	}
	
	public function reorder() {
		$index = 1;
		foreach($_POST['id'] as $picture_id) {
			$this->GalleryPicture->save(array(
				'GalleryPicture' => array(
					'id' => $picture_id,
					'order' => $index
				)
			));
			$index++;
		}
		$this->autoRender = false;
		
	}
	public function crud($id) {
		$this->Gallery->id = $id;
		if(!$this->Gallery->exists()) {
			$this->Session->setFlash(__('La galería especificada no existe'));
			$this->redirect(array('controller' => 'galleries', 'action' => 'index'));
		}

		$this->data = $this->Gallery->read();
	}
	
	public function data($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			
			$is_new = ($this->request->data['Gallery']['id']?false:true);
			
			if($this->Gallery->save($this->request->data)) {
				$this->Session->setFlash(__('Galería guardada con éxito.'));
				
				if($is_new) $this->redirect(array('controller' => 'galleries', 'action' => 'crud', $this->Gallery->id));
				else $this->redirect(array('controller' => 'galleries', 'action' => 'index'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Article->id = $id;
				if(!$this->Article->exists()) {
					$this->Session->setFlash(__('El artículo especificado no existe'));
					$this->redirect(array('controller' => 'articles', 'action' => 'index'));
				}
				$this->data = $this->Article->read();
			}
		}
	}
	
	public function delete($id) {
		$this->Article->id = $id;
		if(!$this->Article->exists()) {
			$this->Session->setFlash(__('El artículo especificado no existe'));
			$this->redirect(array('controller' => 'articles', 'action' => 'index'));
		}
		else {
			$title = $this->Article->field('title');
			$this->Article->delete($id);
			
			$this->Session->setFlash(__('El artículo «%s» fue eliminado con éxito', $title));
			$this->redirect(array('controller' => 'articles', 'action' => 'index'));
		}
	}
	
	public function picture_crud($id) {
		if($this->request->is('post') || $this->request->is('put')) {
			$this->GalleryPicture->save($this->request->data);
			$this->autoRender = false;
			echo '<script>parent.$.fancybox.close();</script>';
		}
		else {
			$this->GalleryPicture->id = $id;
			$this->data = $this->GalleryPicture->read();
			$this->layout = 'popup';
		}
	}
	public function picture_delete() {
		$this->autoRender = false;
		
		$file_name = $this->GalleryPicture->findById($_POST['id']);
		$file_name = $file_name['GalleryPicture']['file_name'];
		@unlink('files/galleries/' . $file_name);
		$file_name = $this->GalleryPicture->delete($_POST['id']);
	}
	
	public function picture_new() {
		$this->autoRender = false;
		if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
			
			$pic_data = $this->VNSFile->savePicture($_FILES['picture'], 835, 398, 'galleries');
			
			$max_order = $this->GalleryPicture->find(
				'first',
				array('order' => array('GalleryPicture.order' => 'DESC'))
			);
			$max_order = $max_order['GalleryPicture']['order'];
			$max_order++;
			
			$this->GalleryPicture->create();
			$this->GalleryPicture->save(array(
				'GalleryPicture' => array(
					'gallery_id' => $_POST['gallery_id'],
					'file_name' => $pic_data,
					'order' => $max_order
				)
			));
		}
		$this->redirect('/galleries/crud/' . $_POST['gallery_id']);
	}
}

?>
