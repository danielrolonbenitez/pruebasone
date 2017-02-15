<?php

include('MySQL.php');
include('EnviaEmail.php');
include('../vendors/recaptchalib.php');





$nombre=$_POST['name'];

$empresa=$_POST['company'];

$email=$_POST['email'];

$mensaje=$_POST['message'];


$captcha=$_POST["g-recaptcha-response"];


// clave secreta
$secret = "6Lf0rBgTAAAAAIhI89Dq-ctJfgcH4XAc4u8HjQiu";
 
// respuesta vacía
$response = null;
 
// comprueba la clave secreta
$re= new ReCaptcha($secret);
     
$response = $re->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );

//var_dump($response) or die();


// tu clave secreta
if($response->success==false){

echo "<script>alert('debes completar el captcha para enviar el formulario');

		window.history.back();
   

</script>";
break;
}











$sql = "INSERT INTO mensajes (nombre, empresa, email, mensaje) values ('{$nombre}','{$empresa}','{$email}','{$mensaje}')";
$MySQL = MySQL::getInstance();
$MySQL->setQuery($sql);
$MySQL->execute();


 $enviaMail= new EnviaEmail();

 $enviaMail->envia($nombre,$empresa,$email,$mensaje);





header('Location:../index.html');






?>