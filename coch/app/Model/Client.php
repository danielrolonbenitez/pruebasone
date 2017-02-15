<?php
App::uses('AppModel', 'Model');
class Client extends AppModel {
	public $validate = array(
		'user' => array(
			'rule'    => 'isUnique',
			'message' => 'Ya existe un usuario con ese nombre.'
		)
	);
	public function afterFind($results, $primary = false) {
		foreach($results as $key => $val) {
			if(isset($val['Client']['password'])) {
				$results[$key]['Client']['password'] = NULL;
			}
		}
		return $results;
	}
	public function beforeSave($options = array()) {
		if(!empty($this->data['Client']['password'])) {
			$this->data['Client']['password'] = md5($this->data['Client']['password']);
		}
		else unset($this->data['Client']['password']);
		return true;
	}

}