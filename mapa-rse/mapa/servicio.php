<?php
ini_set('display_errors',0);
error_reporting(0);
require('../clases/MySQL.php');
$MySQL = MySQL::getInstance();
if(isset($_POST['op'])){
$op = $_POST['op'];

switch($op){
	case 'traerMarkers':
	    $resultados=[];
		$sql = "SELECT locations.id as id, locations.latitude as lat, locations.longitude as lng, locations.camera as camara, locations.text as texto, themes.icon_url as icono,themes.theme_name as tema, locations.theme_id from locations, themes WHERE locations.theme_id = themes.id";
		if(isset($_POST['theme'])){
			$sql .= ' AND locations.theme_id = '.mysql_real_escape_string($_POST['theme']);
		}
		if(isset($_POST['district'])){
			$sql .=  ' AND locations.district_id = '.mysql_real_escape_string($_POST['district']);
		
		}
		$MySQL->setQuery($sql);
	    
		$MySQL->execute();
		$datos = $MySQL->loadObjectList();
		$i = 0;
		foreach($datos as $dato){
			if($i = 0){
				$dato->centro = $dato->lat.","-$dato->lng;
			}
			$sql = "SELECT image from location_images where location_id = $dato->id";
			$MySQL->setQuery($sql);
			$dato->imagenes = $MySQL->loadObjectList();
		}

        /*referentes*/
        if(isset($_POST['district'])){
             $sql = "SELECT referents.organization as empresa,
                     referents.name as nombre,
                     referents.surname as apellido,
					 referents.email as email
                     from referents where district_id='{$_POST['district']}'";
			$MySQL->setQuery($sql);
			$referentes = $MySQL->loadObjectList();
		}
        /*en referentes*/
		$resultados['datos']=$datos;
		$resultados['referentes']=$referentes;
	
		echo json_encode($resultados);
	break;
	case 'getLocationInfo':
	if(isset($_POST['locationId'])){
		$sql = "SELECT locations.id as id, locations.latitude as lat, locations.longitude as lng, locations.camera as camara, locations.text as texto, themes.icon_url as icono,themes.theme_name as tema, locations.theme_id from locations, themes WHERE locations.theme_id = themes.id AND locations.id = '".$_POST['locationId']."'";
		$MySQL->setQuery($sql);
		$datoUbicacion = $MySQL->loadObject();
		$sql = "SELECT image from location_images where location_id = $datoUbicacion->id";
		$MySQL->setQuery($sql);
		$datoUbicacion->imagenes = $MySQL->loadObjectList();
		echo json_encode($datoUbicacion);
	}
	break;
}
}