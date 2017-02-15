<?php
App::uses('AppModel', 'Model');
class ListModel extends AppModel {
	public $useTable = 'lists';
	public $hasMany = array('ListItem');
}