<?php
App::uses('AppModel', 'Model');
class Currency extends AppModel {
	public function afterFind($results, $primary = false) {
		foreach($results as $key => $val) {
			if(isset($val['Currency']['value'])) {
				$results[$key]['Currency']['value'] = str_replace(',', '.', $results[$key]['Currency']['value']);
			}
		}
		return $results;
	}
	public function beforeSave($options = array()) {
		if(!empty($this->data['Currency']['value'])) {
			$this->data['Currency']['value'] = str_replace('.', ',', $this->data['Currency']['value']);
		}
		else $this->data['Currency']['value'] = 1;
		return true;
	}
}