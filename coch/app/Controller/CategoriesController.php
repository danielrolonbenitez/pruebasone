<?php

App::uses("PanelController", "Controller");

class CategoriesController extends PanelController {
	public $uses = array('Category'/*, 'ArticlesPicture', 'ArticleCategory'*/);
	
	public function index() {
		//$this->set('data', $this->paginate());
		$this->Category->recursive = 3;
		$categories = $this->Category->find(
			'all',
			array('order' => array('Category.id ASC'))
		);
		$this->set(compact('categories'));
	}
	
	public function add_child($id) {
		$this->set('category_id', $id);
		$this->render('crud');
	}
	public function crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Category->save($this->request->data)) {				
				$this->Session->setFlash(__('Categoría guardada con éxito.'));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			else $this->Session->setFlash(__('No se pudieron guardar los cambios.'));
		}
		else {
			//$this->set('categories', $this());
			if($id) {
				$this->Category->id = $id;
				if(!$this->Category->exists()) {
					$this->Session->setFlash(__('La categoría especificada no existe'));
					$this->redirect(array('controller' => 'category', 'action' => 'index'));
				}
				$this->data = $this->Category->read();
			}
		}
	}
	public function delete($id) {
		$this->Category->id = $id;
		if(!$this->Category->exists()) {
			$this->Session->setFlash(__('La categoría especificada no existe'));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		else {
			$title = $this->Category->field('name');
			$this->Category->delete($id);
			$this->Category->deleteAll(array('Category.category_id' => $id));
			
			$this->Session->setFlash(__('La categoría «%s» fue eliminada con éxito', $title));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
	}
}

?>
