<?php
include_once('admin/clases/MySQL.php');
include_once('admin/models/mainModel.php');

if(isset($_POST['dni']) && !empty($_POST['dni'])) {
	$dni = filter_input(INPUT_POST, 'dni');
	$MainModel = new MainModel();
	if($MainModel->validateDNI($dni)) {
		echo json_encode('true');
	} else {
		echo json_encode('false');
		
	}

}


?>