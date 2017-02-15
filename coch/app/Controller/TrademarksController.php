<?php

App::uses("PanelController", "Controller");

class TrademarksController extends PanelController {
	public $uses = array('Trademark');
	
	public function index() {
		$this->set('data', $this->paginate());
	}
	
	public function add_child($id) {
		$this->set('product_id', $id);
		$this->render('crud');
	}
	public function crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Trademark->save($this->request->data)) {
				if($_FILES['picture'] && $_FILES['picture']['error'] == 0) {
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 76);
					
					$current_pic = $this->Trademark->read();
					
					if(file_exists('../webroot/files/' . $current_pic['Trademark']['picture']) && is_file('../webroot/files/' . $current_pic['Trademark']['picture'])) @unlink('../webroot/files/' . $current_pic['Trademark']['picture']);
					
					$this->Trademark->save(array(
						'Trademark' => array(
							'id' => $this->Trademark->id,
							'picture' => $filename
						)
					));
					
					/*$this->ArticlesPicture->deleteAll(array('ArticlesPicture.article_id' => $this->Article->id));
					$this->ArticlesPicture->save(array(
						'ArticlesPicture' => array(
							'article_id' => $this->Article->id,
							'file_name' => $filename
						)
					));*/
				}
				$this->Session->setFlash(__('Marca guardada con éxito.'));
				$this->redirect(array('controller' => 'trademarks', 'action' => 'index'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Trademark->id = $id;
				if(!$this->Trademark->exists()) {
					$this->Session->setFlash(__('La marca especificada no existe'));
					$this->redirect(array('controller' => 'trademarks', 'action' => 'index'));
				}
				$this->data = $this->Trademark->read();
			}
		}
	}
	public function delete($id) {
		$this->Trademark->id = $id;
		if(!$this->Trademark->exists()) {
			$this->Session->setFlash(__('El producto especificado no existe'));
			$this->redirect(array('controller' => 'trademarks', 'action' => 'index'));
		}
		else {
			$title = $this->Trademark->field('name');
			$this->Trademark->delete($id);
			//$this->Trademark->deleteAll(array('Trademark.product_id' => $id));
			
			$this->Session->setFlash(__('La marca «%s» fue eliminada con éxito', $title));
			$this->redirect(array('controller' => 'trademarks', 'action' => 'index'));
		}
	}
}

?>
