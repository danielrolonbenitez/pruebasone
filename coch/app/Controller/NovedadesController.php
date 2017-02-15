<?php
App::uses("AdmController", "Controller");
class NovedadesController extends AdmController {
	public $uses = array('Gallery', 'Article', 'Category', 'BusinessType', 'NewsletterSubscription', 'Product');
	
	public function index($slug = null) {
		$this->paginate = array(
			'Article' => array(
				'limit' => 5,
				//'conditions' => array('Article.published' => 1),
				'order' => array('Article.created' => 'DESC')
			)
		);
		$this->set('data', $this->paginate('Article'));
	}
	public function ver($slug) {
		$id_noticia = array();
		$is_valid_slug = preg_match('/-([0-9]+)\.html/', $slug, $id_noticia);

		if($is_valid_slug) {
			$id_noticia = $id_noticia[1];
			$this->Article->id = $id_noticia;
			if(!$this->Article->exists()) $this->redirect('/');
			else {
				$this->set('article', $this->Article->read());
			}
		}
		else $this->redirect('/');
	}
}