<?php
App::uses('PanelController', 'Controller');
class PagesController extends PanelController {
	public $uses = array('Page', 'Picture', 'Video');
	
	public function crud($id) {
		if($this->request->is('post') || $this->request->is('put')) {
			$this->Page->save($this->request->data);
			$this->Session->setFlash('La página fue guardada con éxito.');
			$this->redirect('/pages/crud/' . $id);
		}
		$this->data = $this->Page->findById($id);
	}
	
	public function index() {
		
	}
	
	
	
	
	
	
	public function gallery_index() {
		$this->set('data', $this->Picture->find(
			'all',
			array(
				'order' => array('Picture.order')
			)
		));
	}

		
	public function gallery_reorder() {
		$index = 1;
		foreach($_POST['id'] as $picture_id) {
			$this->Picture->save(array(
				'Picture' => array(
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
			$this->Picture->save($this->request->data);
			$this->autoRender = false;
			echo '<script>parent.$.fancybox.close();</script>';
		}
		else {
			$this->Picture->id = $id;
			$this->data = $this->Picture->read();
			$this->layout = 'popup';
		}
	}
	public function gallery_picture_delete() {
		$this->autoRender = false;
		
		$file_name = $this->Picture->findById($_POST['id']);
		$file_big = $file_name['Picture']['file_big'];
		$file_name = $file_name['Picture']['file_name'];
		@unlink('files/' . $file_name);
		@unlink('files/' . $file_big);
		$file_name = $this->Picture->delete($_POST['id']);
	}
	
	public function gallery_picture_new() {
		$this->autoRender = false;
		if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
			
			$pic_data_big = $this->VNSFile->savePicture($_FILES['picture'], 831);
			$pic_data = $this->VNSFile->savePicture($_FILES['picture'], 289, 193);
			
			
			$max_order = $this->Picture->find(
				'first',
				array('order' => array('Picture.order' => 'DESC'))
			);
			if($max_order) $max_order = $max_order['Picture']['order'];
			else $max_order = 0;
			$max_order++;
			
			$this->Picture->create();
			$this->Picture->save(array(
				'Picture' => array(
					'file_name' => $pic_data,
					'file_big' => $pic_data_big,
					'order' => $max_order
				)
			));
		}
		$this->redirect('/pages/gallery_index/');
	}
	
	
	
	
	
	
	
	
	
	
	
		
	public function videos() {
		$this->set('data', $this->paginate('Video'));
	}
	
	public function video_crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Video->save($this->request->data)) {
				$this->Session->setFlash(__('Ítem guardado con éxito.'));
				$this->redirect(array('controller' => 'pages', 'action' => 'videos'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Video->id = $id;
				if(!$this->Video->exists()) {
					$this->Session->setFlash(__('El ítem especificado no existe'));
					$this->redirect(array('controller' => 'pages', 'action' => 'videos'));
				}
				$this->data = $this->Video->read();
			}
			else {
				//$this->set('videos', $this->Video->find('all'));
			}
		}
	}
	
	
	public function video_delete($id) {
		$this->Video->id = $id;
		if(!$this->Video->exists()) {
			$this->Session->setFlash(__('El ítem especificado no existe'));
			$this->redirect(array('controller' => 'pages', 'action' => 'videos'));
		}
		else {
			$title = $this->Video->field('description');
			$this->Video->delete($id);
			
			$this->Session->setFlash(__('El ítem fue eliminado con éxito'));
			$this->redirect(array('controller' => 'pages', 'action' => 'videos'));
		}
	}
}
