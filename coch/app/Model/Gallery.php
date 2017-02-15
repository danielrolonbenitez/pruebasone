<?php
App::uses('AppModel', 'Model');
class Gallery extends AppModel {
	public $hasMany = array(
		'GalleryPicture' => array(
			'order' => 'GalleryPicture.order ASC'
		)
	);
	public $validate = array();
	public function __construct() {
		$this->validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'message' => __('El nombre es obligatorio', true)
			)
		);
		parent::__construct();
	}
}