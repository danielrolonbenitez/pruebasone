<?php
App::uses('AppModel', 'Model');
class Article extends AppModel {
	// public $msg_title = __('El título es obligatorio');
	
	public $validate = array();
	public function __construct() {
		$this->validate = array(
			'title' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'message' => __('El título es obligatorio', true)
			)
		);
		parent::__construct();
	}
}