<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
define('BASE_PATH','admin/');
include("clases/MySQL.php");
include("clases/Upload.php");
include("clases/paginator.php");
include("controllers/mainController.php");
include("models/mainModel.php");
include("controllers/panel.php");


$panel = new Panel();
if(!isset($_GET['a'])){
	$metodo = "inscriptos";
}
else{
	$metodo = $_GET['a'];
}

if($metodo != "usr"){
	if(!isset($_SESSION['registrado'])){
		$metodo = "login";
	}
}
if($metodo == ""){
	$metodo = "inscriptos";
}
//die($metodo);
$panel->$metodo();
?>