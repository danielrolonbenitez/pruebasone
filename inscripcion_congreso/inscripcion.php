<?php
        include('admin/clases/MySQL.php');
		include('admin/models/mainModel.php');
		include('admin/controllers/mainController.php');
		$mainModel = new MainModel();
		$mainController = new MainController();
		$datos = $_POST;
		$inscripto = $mainModel->traerInscriptoDNI($datos['dni']);			
		$aprobado = false;
		$datos['affiliate'] = 0;
		$datos['payment'] = 0;
		$afiliado = $mainModel->buscarAfiliado($datos['dni']);
		//var_dump($afiliado);die;

$validate = true;
foreach($_POST as $key => $value){
	if($key == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)){
		$validate = false;
		$mensaje = 'Por favor escriba una direccion de correo válida';
	}
	if($key == 'district'){
		$district = preg_replace("/[^0-9]/", "",$value);
		if($district > 21){
			$validate = false;
			$mensaje = 'El D.E. debe ser inferior o igual a 21';
		}
	}
	if($key == 'dni' && !((int) $value>0)){
		$validate = false;
		$mensaje = 'El D.N.I debe ser real';
	}

	if($afiliado == null){
		$validate = false;
		$mensaje = 'Su DNI no figura en nuestra base de datos, por favor contáctese con CAMYP';
	  }else if($afiliado->payment == 0){
				$validate = false;
				$mensaje = 'No se registro pago en nuestra base de datos, por favor contáctese con CAMYP';
			}
	

	if($value == ''){
		$validate = false;
		$mensaje = 'Por favor complete todos los campos';
	}
}
if(!$validate){
?>
<script type="text/javascript">
alert('<?php echo $mensaje; ?>');
history.go(-1);
</script>
<?php
die;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Congreso Político Educativo CAMYP</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<!--[if gte IE 9]
<style type="text/css">
.gradient {
filter: none;
}
</style>
<![endif]-->
<style>
#banner img{
max-width: 100%;
width: 400px;
}
</style>
</head>

<body>
<div id="header">
	<div id="logos" class="wrapper">
        <img src="img/logo_camyp.png" width="215" height="59" alt="" class="left"/>
        <img src="img/logo_dac.png" width="205" height="64" alt="" class="right"/>
    </div>
	<div id="banner">
   	  <div class="borderGradient gradient"></div>
    	<div class="headerGradient gradient">
        	<img src="img/logo.png" alt=""/>
        </div>
    	<div class="borderGradient gradient"></div>
    </div>
</div>
	<div class="wrapper">
        <?php
		
		if($afiliado!=null){	
				if($afiliado->status == 'Activo'){
					$datos['affiliate'] = 1;
				}
				if($afiliado->payment > 0){
					$datos['payment'] = 1;
				}
				
				if($afiliado->status == 'Activo' && $afiliado->payment > 0) {		
					$aprobado = true;
				}
	    }
		if(count($inscripto)==0){
			
			$nro_inscipcion = $mainController->nuevaInscripcion($datos);
			if($aprobado){
			?>
				<h2>Gracias por su suscripción!</h2>
                <p>Su preinscripción ha sido aprobada. </p>
                <p>Para completarla deberá presentar el <u>Abstract</u> el miércoles 7 de septiembre de  2016 en CAMYP - Oruro 1212(CABA). de 11.00 a 17:45 hrs.</p>
            <?php
			}
			else{
			?>
				<h2>ATENCIÓN!</h2>
      			<p>Su preinscripción aún no se ha podido completar. Un representante de CAMYP se contactará con usted a la brevedad.</p>
            <?php
			}
			?>
        		<p>Por favor tome nota del código de registro <span class="nro_registro"><?php echo str_pad ( $nro_inscipcion , 7 , 0  , STR_PAD_LEFT ); ?></span></p>
            <?php
		}
		elseif($aprobado){ 
		?>
		<h2>Gracias por su suscripción!</h2>
        <p>Ya se encuentra preinscripto con el número de registro <span class="nro_registro"><?php echo $inscripto->id; ?></span></p>
        
        <?php if($inscripto->abstract == 0){ ?>
        <p>Para completarla deberá presentar el <u>Abstract</u>el miércoles 7 de septiembre de  2016 en CAMYP - Oruro 1212(CABA). de 11.00 a 17:45 hrs.</p>
		<?php } ?>
        
        <?php
		}
		else{
			?>
				<h2>ATENCIÓN!</h2>
      			<p>Su preinscripción aún no se ha podido completar. Un representante de CAMYP se contactará con usted a la brevedad.</p>
        		<p>Por favor tome nota del código de registro <span class="nro_registro"><?php echo $inscripto->id; ?></span></p>
            <?php
		}
		?>
       
        
	</div>
</body>
</html>