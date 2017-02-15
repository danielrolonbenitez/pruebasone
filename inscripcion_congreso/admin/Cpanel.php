<?php
@set_time_limit(0);
error_reporting(E_ERROR);

include("clases/MySQL.php");
include("clases/Upload.php");
include("controllers/mainController.php");

$MySQL = MySQL::getInstance ();

if(isset($_POST['op'])){
	$operacion = $_POST['op'];
}
else{
	$operacion = $_GET['op'];
}
				
$mainController = new MainController();

switch($operacion){
	
	case 1:
		$id = $mainController->actualizarAbstracts($_POST);
		if($id!==false){
			header("location: index.php");
		}
		break;
	
	case 2:
		$id = $mainController->actualizarInscripto($_POST);
		if($id!==false){
			header("location: index.php");
		}
		break;
}

?>