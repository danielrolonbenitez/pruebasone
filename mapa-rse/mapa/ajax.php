<?php
include_once('../clases/MySQL.php');
$MySQL = MySQL::getInstance();


if(isset($_GET['cities'])) {
	$id = $_GET['cities'];

	$sql = "SELECT * FROM cities WHERE district_id = " . sprintf('%d', $id) . " ORDER BY city_name";
	$MySQL->setQuery($sql);
	$sql_cities = $MySQL->loadObjectList();
	
	$cities = array();
	foreach($sql_cities as $city) {
		$cities[sprintf('%d', $city->ID)] = $city->city_name;
	}
	echo json_encode($cities);
}
if(isset($_GET['path'])) {
	echo 'var basepath = "' . $_GET['path'] . '";';
}