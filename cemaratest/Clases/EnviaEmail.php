<?php
include('phpmailer/class.phpmailer.php');


class EnviaEmail{
	



public function envia($nombre, $empresa, $email,$mensaje){
	


//intancio php mail

  $mail = new PHPMailer();

//Send mail using gmail

    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "smtpserverprueba@gmail.com"; // GMAIL username
    $mail->Password = "2688abcd"; // GMAIL password


    $mail->AddAddress("daniel.benitez@vnstudios.com","daniel");
                              $mail->SetFrom("vnstudios@gmail.com", "vnstudios@gmail.com");
                             $mail->Subject = "Datos De Contacto";


                  
       //formateo el elmail//

          $msg="<html><head></head><body>

				 
            <div>

            <span>Nombre:</span>&nbsp;<span>{$nombre}</span><br>
            <span>Empresa:</span>&nbsp;<span>{$empresa}</span><br>
            <span>Email:</span>&nbsp;<span>{$email}</span><br>
            <span>Mensaje:</span>&nbsp;<span>{$mensaje}</span><br>


            </div>



          </body></html>";





                                            $mail->MsgHTML($msg);
                                            $mail->Send();
                                                //try{
                                                    //$mail->Send();
                                                   // echo "Success!";
                                              // } catch(Exception $e){
                                                    //Something went bad
                                                   // echo "Fail :(";
                                               // }








}







}//end class





?>