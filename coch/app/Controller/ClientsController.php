<?php

App::uses("PanelController", "Controller");

class ClientsController extends PanelController {
	public $uses = array('Client');
	
	public function index() {
		$this->set('data', $this->paginate());
	}
	public function crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Client->save($this->request->data)) {
				/*if($_FILES['picture'] && $_FILES['picture']['error'] == 0) {
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 298, 169);
					/*$this->ArticlesPicture->deleteAll(array('ArticlesPicture.article_id' => $this->Article->id));
					$this->ArticlesPicture->save(array(
						'ArticlesPicture' => array(
							'article_id' => $this->Article->id,
							'file_name' => $filename
						)
					));*//*
					$this->Article->save(array(
						'Article' => array(
							'id' => $this->Article->id,
							'picture' => $filename
						)
					));
				}*/
				
				$this->Session->setFlash(__('Cliente guardado con éxito.'));
				$this->redirect(array('controller' => 'clients', 'action' => 'index'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Client->id = $id;
				if(!$this->Client->exists()) {
					$this->Session->setFlash(__('El cliente especificado no existe'));
					$this->redirect(array('controller' => 'clients', 'action' => 'index'));
				}
				$this->data = $this->Client->read();
			}
		}
	}
	public function delete($id) {
		$this->Client->id = $id;
		if(!$this->Client->exists()) {
			$this->Session->setFlash(__('El cliente especificado no existe'));
			$this->redirect(array('controller' => 'clients', 'action' => 'index'));
		}
		else {
			$title = $this->Client->field('title');
			
			$this->Client->delete($id);
			$this->Session->setFlash(__('El cliente «%s» fue eliminado con éxito', $title));
			
			$this->redirect(array('controller' => 'clients', 'action' => 'index'));
		}
	}
}

?>
