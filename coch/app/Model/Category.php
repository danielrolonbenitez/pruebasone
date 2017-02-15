<?php
App::uses('AppModel', 'Model');
class Category extends AppModel {
	public $displayField = 'name';
	public $belongsTo = array(
		'Parent' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id'
		)
	);
	/*public $hasMany = array(
		'Child' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id'
		)
	);*/
	public $hasMany = 'Category';
	/*public $hasMany = array(
		'Child' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id'
		)
	);*/
	
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