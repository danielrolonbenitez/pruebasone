<?php
App::uses('AppModel', 'Model');
class ListItem extends AppModel {
	public $belongsTo = array('ProductVariant', 'List');
}