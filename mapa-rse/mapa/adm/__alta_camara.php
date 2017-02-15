<? include_once("init.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_titulopagina_?></title>
<link href="images/panel.css" rel="stylesheet" type="text/css" />
<link href="adm.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/panel.js"></script>
<script src="js/ciudades.js"></script>
</head>
<body>
<? include_once("panel.php");?>
<div class="containergral">
 
 <div class="titulobloque">Ingreso de Cámara</div>
    
   <? if($_POST[enviar])
   {
   $sql="insert into camaras set cam_nombre='$_POST[nombre]', cam_abreviacion='$_POST[av]', cam_domicilio='$_POST[domicilio]',  cam_pisodepto='$_POST[piso]', cam_id_ciudad='$_POST[ciudad]', cam_id_provincia='$_POST[provincia]', cam_telefono='$_POST[telefono]', cam_email='$_POST[email]', cam_web='$_POST[email]', cam_imagen='', cam_descripcion='$_POST[descripcion]'";
   $query=mysql_query($sql);
   echo mysql_error();
   
   echo "<br><br>La Cámara <b>".strtoupper($nombre)."</b> se ha incorporado correctamente.";
   ?><br /><br /><br /><br />
   <div>
   <a href="alta_camara.php">Ingresar una nueva Cámara</a>&nbsp;&nbsp;&nbsp;<a href="alta_camara.php">Ver el Listado</a></div>
   <?
   }
   else
   {
   ?>
  <form action="alta_camara.php" method="post" class="formularios" onsubmit="return validar_alta_cam();">
    <div class="lab">Nombre de la Cámara</div>
    <input id="nombre" name="nombre" type="text" style="width:300px" />
    
    <div  class="lab">Abreviatura</div>
    <input name="av" type="text" id="av" />
    
     <div  class="lab">Email</div>
    <input id="email" name="email" type="text" />
    
    
    <div  class="lab">Dirección - Calle y Número</div>
    <input id="direccion" name="direccion" type="text" />
    <div  class="lab">Piso / Dpto</div>
    <input id="piso" name="piso" type="text" />
   
   <div  class="lab">Provincia</div>
    <select name="provincia" id="provincia" onchange="pushcity()">
    <option value="0" >< Seleccione ></option>
    <?
	$sql="select * from d_provincia";
	$query=mysql_query($sql);
	while($dat=mysql_fetch_array($query))
	echo '<option value="'.$dat[id_provincia].'">'.utf8_encode($dat[desc_provincia]).'</option>';
	?>
    </select>
  
   
   <div  class="lab">Ciudad</div>
    <select name="ciudad" id="ciudad">
     <option value="0">< Seleccione ></option>
    </select>
  
  
   
    <div  class="lab">Federación</div>
    
    <select name="federacion" id="federacion">
     <option value="0">< Seleccione ></option>
    </select>
	
   
       
    <div  class="lab">Descripción General</div>
    <textarea name="descripcion" id="descripcion" cols="45" rows="5"></textarea>
    <br />
   
   <input name="enviar" type="submit" id="enviar" style="" value="Enviar formulario" />
    
    </form>
<?
}
?>
</div>
</body>
</html>
