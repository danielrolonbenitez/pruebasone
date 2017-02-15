<?php
require_once('clases/mysql.php');

if(isset($_POST['g-recaptcha-response'])){
	$secret = '6Lf1kwsUAAAAAC2dgoRmq1YhTcWQ5wTJjPSSoblJ';
	$response = $_POST['g-recaptcha-response'];
	$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
	$captcha_success=json_decode($verify);

	if($captcha_success->success == false){
		echo 'Por favor responde el captcha correctamente';
	}

} else {
	echo 'Por favor responde el captcha correctamente';
}


$nombre     = filter_input(INPUT_POST, 'Nombre', FILTER_SANITIZE_STRING);
$email      = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
$videoLink  = filter_input(INPUT_POST, 'VideoLink', FILTER_SANITIZE_STRING);
$telefono   = filter_input(INPUT_POST, 'Telefono', FILTER_SANITIZE_STRING); 
$edad       = filter_input(INPUT_POST, 'Edad', FILTER_SANITIZE_STRING);
$dni        = filter_input(INPUT_POST, 'DNI', FILTER_SANITIZE_STRING);

$error  = validateEmail($email);

if ($error['status'] == false) {
	echo $error['msg'];
} else {
	$error  = validateNombre($nombre);
	if($error['status'] == false){
		echo $error['msg'];
	} else {
		$notificoFecoba = sentNotification($nombre, $email, $videoLink, $telefono, $edad, $dni, $type="fecoba", 'jovenes@fecoba.org.ar');
		if($notificoFecoba['status'] == false){
			echo $notificoFecoba['msg'];
		} else {
			$insertUser = insertUser($nombre, $email, $videoLink, $telefono, $edad, $dni);
			if($insertUser['status'] == false) {
				echo $insertUser['msg'];
			} else {
				$notificoUsuario = sentNotification($nombre, $email, $videoLink, $telefono, $edad, $dni, $type="user", $email);		
				if($notificoUsuario == false){
					echo $insertUser['msg'];
				} else {
					echo $insertUser['msg'].' - En breve recibirá su confirmación vía email'; 	
				}
				
			}
		}

	}
}


function validateEmail($email){
	if($email !=''){
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return  ['status' => false, 'msg' => 'Por favor ingrese un email válido'];
		} else {
			$query = "SELECT * FROM cf WHERE email = '$email'";

			$MySQL = MySQL::getInstance();
			$MySQL->setQuery($query);
			$MySQL->execute();
			$result = $MySQL->getNumRows();

			if($result==1){
				return  ['status' => false, 'msg' => '<span>Muchas Gracias! Sus datos ya se encuentran registrados.</span>'];
			} else {
				return  ['status' => true, 'msg' => ''];
			}
		}
	} else {
		return ['status' => false, 'msg' => 'Por favor ingrese un email'];
	}
}


function validateNombre($nombre){
	if($nombre !=''){
	
		return  ['status' => true, 'msg' => ''];
		
	} else {
		return ['status' => false, 'msg' => 'Por favor ingrese su nombre'];
	}
}


function insertUser($nombre, $email, $videoLink, $telefono, $edad, $dni){


	$query =  "INSERT INTO cf (`nombre`,`email`,`telefono`,`dni`,`video`,`edad`) VALUES ('{$nombre}','{$email}','{$telefono}','{$dni}','{$videoLink}','{$edad}')";	
file_put_contents('q.txt', $query);
	$MySQL = MySQL::getInstance();
	$MySQL->setQuery($query);

	if($MySQL->execute()){
		return  ['status' => true, 'msg' => 'Sus datos han sido registrados satisfactoriamente'];
	} else {
		return ['status' => false, 'msg' => 'Ha ocurrido un error, por favor intentlo mas tarde'];
	}
}

function sentNotification($nombre, $email, $videoLink, $telefono, $edad, $dni, $type="fecoba", $dest){
	$headers = "From: Registro WEB Info <noreply@premiociudadjoven.com>\r\n"; //Quien envia?
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //
	
    $cuerpo = '';

    if($type=='fecoba'){
		$asunto = "Nueva Registracion de " . $nombre; //Email de destino
    	
    } else if($type == 'user'){
    	$asunto = "Registro: Premio Ciudad Joven"; //Email de destino

        $cuerpo = "Gracias por registrarse; pronto nos pondremos en contacto con usted!<br /><br /> Sus datos son:<br />Nombre: " . $nombre;
        
    } else {
    	return ['status' => false, 'msg' => 'Ha ocurrido un error, por favor intentlo mas tarde'];
    }

    $cuerpo .= "<br />Email: " . $email;
    $cuerpo .= "<br />Video: " . $videoLink;
    $cuerpo .= "<br />Telefono: " . $telefono;
    $cuerpo .= "<br />Edad: " . $edad;
    $cuerpo .= "<br />DNI: " . $dni;

    if( mail($dest,$asunto,$cuerpo,$headers) != false){
    	return ['status' => true, 'msg' => ''];
    } else {

    	return ['status' => false, 'msg' => 'Ha ocurrido un error, por favor intentlo mas tarde'];
    }
}
    
?>
