<?php
include ('clases/MySQL.php');
include("models/mainModel.php");
if(isset($_POST['op']))$operacion = $_POST['op'];
else $operacion = $_GET['op'];

if(isset($_POST['id']))$id = $_POST['id'];
$MySQL = MySQL::getInstance();
$mainModel = new MainModel();

switch($operacion){
	
	case 'borrar_inscripcion':
		
		$sql = "DELETE FROM enrolled WHERE id = {$id} ";
		$MySQL->setQuery ($sql);
		
		if($MySQL->execute()) {	
			echo 'borrado!';
		}
		else {
			echo 'no fue posible borrar';
		}
	
	break;
}
	
	?>