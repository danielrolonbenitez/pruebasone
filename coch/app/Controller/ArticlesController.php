<?php

App::uses("PanelController", "Controller");

class ArticlesController extends PanelController {
	public $uses = array('Article', 'ArticlesPicture', 'ArticleCategory');
	
	public function index() {
		if(!empty($this->request->data['Article']['type'])) {
			$this->paginate = array(
				'limit' => 10000000,
				'conditions' => array(
					'Article.title LIKE' => '%' . $this->request->data['Article']['title'] . '%'
				)
			);
		}
		$this->set('data', $this->paginate());
	}
	public function crud($id = null) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Article->save($this->request->data)) {
				if($_FILES['picture'] && $_FILES['picture']['error'] == 0) {
					$filename = $this->VNSFile->savePicture($_FILES['picture'], 298, 169);
					$filename_big = $this->VNSFile->savePicture($_FILES['picture'], 570, 323);
					/*$this->ArticlesPicture->deleteAll(array('ArticlesPicture.article_id' => $this->Article->id));
					$this->ArticlesPicture->save(array(
						'ArticlesPicture' => array(
							'article_id' => $this->Article->id,
							'file_name' => $filename
						)
					));*/
					$this->Article->save(array(
						'Article' => array(
							'id' => $this->Article->id,
							'picture' => $filename,
							'picture_big' => $filename_big
						)
					));
				}
				
				$this->Session->setFlash(__('Artículo guardado con éxito.'));
				$this->redirect(array('controller' => 'articles', 'action' => 'index'));
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
			$is_in_home = $this->Article->field('in_home');
			if($is_in_home == 1) {
				$this->Session->setFlash(__('El artículo «%s» no se puede eliminar porque está en la página principal.', $title));
			}
			else {
				$this->Article->delete($id);
				$this->Session->setFlash(__('El artículo «%s» fue eliminado con éxito', $title));
			}
			$this->redirect(array('controller' => 'articles', 'action' => 'index'));
		}
	}
	public function set_home_article($id) {
		$this->Article->updateAll(
			array('Article.in_home' => 0),
			true
		);
		$this->Article->save(array(
			'Article' => array(
				'id' => $id,
				'in_home' => 1
			)
		));
		die();
	}
}

?>
