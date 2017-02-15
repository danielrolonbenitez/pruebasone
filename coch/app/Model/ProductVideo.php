<?php
App::uses('AppModel', 'Model');
class ProductVideo extends AppModel {
	public $belongsTo = array('Product');
	/*public function afterFind($results, $primary = false) {
		if($primary) {
			foreach($results as $k => $result) {
				if(!empty($results[$k]['ProductVideo'])) {
					$results[$k]['ProductVideo']['youtube_id'] = '';
					$match = array();

					$url = $results[$k]['ProductVideo']['youtube_url'];
					$url = preg_replace('/\?.*$/', '', $url);
					$url = preg_match('/tu\.be\/([a-zA-Z0-9\.\-\_\+]+)/', '', $match);
					if($url) $results[$k]['ProductVideo']['youtube_id'] = $match[1];
				}
			}
		}
		return $results;
	}*/
}