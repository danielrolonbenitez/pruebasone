<?php
App::uses('AppModel', 'Model');
class Product extends AppModel {
	public $hasMany = array('ProductSpec', 'ProductFeature', 'ProductVideo', 'ProductSpecPic', 'ProductPicture', 'ProductDownload');
	public function afterFind($results, $primary = false) {
		if($primary) {
			foreach($results as $k => $result) {
				if(!empty($results[$k]['Product'])) {
					$results[$k]['Product']['name_blue'] = substr($result['Product']['name'], 0, strpos($result['Product']['name'], ' '));
					$results[$k]['Product']['name_red'] = substr($result['Product']['name'], strpos($result['Product']['name'], ' ') + 1);
					
					$results[$k]['Product']['list_specs'] = explode("\n", $result['Product']['specifications']);
				}
			}
		}
		return $results;
	}
}