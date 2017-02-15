<?php
$destinatario = 'dfdegafil@gmail.com';

$resultado = array();
if(empty($_REQUEST['contact_name'])) $resultado['error'] = 'El nombre es obligatorio';
elseif(empty($_REQUEST['contact_email'])) $resultado['error'] = 'La dirección de mail es obligatoria';
elseif(!filter_var($_REQUEST['contact_email'], FILTER_VALIDATE_EMAIL)) $resultado['error'] = 'La dirección de mail ingresada no es válida';
elseif(empty($_REQUEST['contact_message'])) $resultado['error'] = 'El mensaje es obligatorio';
else {
	mail(
		$destinatario,
		"Formulario de contacto DfFiltros",
		"Nombre: " . $_REQUEST['contact_name'] . "\nE-Mail: " . $_REQUEST['contact_email'] . "\nEmpresa: " . $_REQUEST['contact_empresa'] . "\nMensaje: " . $_REQUEST['contact_message'],
		"From: DfFiltros <noreply@dffiltros>\r\nContent-Type: text/plain;charset=UTF-8"
	);
	$resultado['status'] = 'ok';
}


echo json_encode($resultado);

