<?php
//App::uses('AppModel', 'Model');
class ArticleCategory extends AppModel {
	// public $msg_title = __('El título es obligatorio');
	
	public $validate = array();
	public function __construct() {
		/*$this->validate = array(
			'title' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'message' => __('El título es obligatorio', true)
			)
		);*/
		parent::__construct();
	}
	
	public function getList() {
		$parents = $this->find(
			'list',
			array(
			'conditions' => array('ArticleCategory.article_category_id' => NULL),
			'order' => array(
				'ArticleCategory.order' => 'ASC',
				'ArticleCategory.id' => 'ASC'
			)
		));
		
		$results = array();
		foreach($parents as $parent_id => $parent_name) {
			$results[$parent_id] = $parent_name;
			
			$children = $this->find(
				'list',
				array(
				'conditions' => array('ArticleCategory.article_category_id' => $parent_id),
				'order' => array(
					'ArticleCategory.order' => 'ASC',
					'ArticleCategory.id' => 'ASC'
				)
			));
			foreach($children as $child_id => $child_name) {
				$results[$child_id] = ' - ' . $child_name;
			}
		}
		return $results;
	}
}