<? include_once("../init.php")?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<script src="../js/jquery.js"></script>

<script src="../adm/js/ciudades.js"></script>
<script>

$("document").ready(function(){

	$("#provincia").find("option:eq[2]").attr("selected","selected");
	});


</script>

<body>
<? include_once("../init.php")?><?


	
	//MAPA ESTADO 0'
	mysql_query("update camaras set mapa_estado='0'");
	mysql_query("update federaciones set mapa_estado='0'");
	exit;
	

function corregir_datos()
{
	mysql_query("update camaras set cam_imagen='',cam_eliminado='0', cam_suspendido='0', cam_descripcion='',mapa_estado='0'");
	echo mysql_error();

	$query=mysql_query("select * from camaras");
	while($dat=mysql_fetch_array($query))
	{
	//echo ord("º");
		
		
		//$c=trim(str_replace("NÂº ","",utf8_encode($dat[cam_calle_numero])));
		$c=explode("º",$dat[cam_calle_numero]);
		$c=trim($c[1]);
		if($c>"")
		{
		$sql="update camaras set cam_calle_numero='$c' where id_camara='$dat[id_camara]'";
		//echo $sql; exit;
		mysql_query($sql);
		}
		else
		{
			$c=explode("°",$dat[cam_calle_numero]);
			$c=trim($c[1]);
			if($c>"")
			{
			$sql="update camaras set cam_calle_numero='$c' where id_camara='$dat[id_camara]'";
			//echo $sql; exit;
			mysql_query($sql);
			}
		}		
	
		
		
		
	}
}

function ut()
{
	$query=mysql_query("select * from camaras");
	while($dat=mysql_fetch_array($query))
	{
		foreach($dat as $key=>$val)
		$dat[$key]=utf8_encode($val);
		$sql="update camaras set cam_nombre='$dat[cam_nombre]' where id_camara='$dat[id_camara]'";
		//echo $sql; exit;
		mysql_query($sql);
	}
}

if($_GET[idcam])
{

	mysql_query("update camaras set cam_id_ciudad='$_GET[ciudad]', cam_id_provincia='$_GET[provincia]' where id_camara='$_GET[idcam]'");
	
	
	

}

function ttrim($a)
{
	foreach($a as $key=>$val)
	{
	$a[$key]=addslashes(trim($val));
	}
	return $a;
}	

function qacentos($s) { 
   $s = ereg_replace("[áàâãª]","a",$s); 
   $s = ereg_replace("[ÁÀÂÃ]","A",$s); 
   $s = ereg_replace("[ÍÌÎ]","I",$s); 
   $s = ereg_replace("[íìî]","i",$s); 
   $s = ereg_replace("[éèê]","e",$s); 
   $s = ereg_replace("[ÉÈÊ]","E",$s); 
   $s = ereg_replace("[óòôõº]","o",$s); 
   $s = ereg_replace("[ÓÒÔÕ]","O",$s); 
   $s = ereg_replace("[úùû]","u",$s); 
   $s = ereg_replace("[ÚÙÛ]","U",$s); 
   $s = str_replace("ç","c",$s); 
   $s = str_replace("Ç","C",$s); 
   return $s; 
}  


function provCam()
{

 $p=qacentos(strtolower("25:Capital Federal;1:Gran Buenos Aires;2:Buenos Aires;3:Catamarca;4:Chaco;5:Chubut;6:Córdoba;7:Corrientes;8:Entre Ríos;9:Formosa;10:Jujuy;11:La Pampa;12:La Rioja;13:Mendoza;14:Misiones;15:Neuquén;16:Río Negro;17:Salta;18:San Juan;19:San Luis;20:Santa Cruz;21:Santa Fe;22:Santiago Del Estero;23:Tierra del Fuego;24:Tucumán"));
	
	$p=explode(";",$p);
	foreach($p as $val)
	{
		$p=explode(":",$val);
		$n[$p[0]]=$p[1];
		$n2[$p[1]]=$p[0];
	}
	
	$sql="select *  from camaras where cam_id_provincia is NULL";
	$query=mysql_query($sql); echo mysql_error();
	while($dat=mysql_fetch_array($query))
	{
		$x=array_search(strtolower(qacentos($dat[provincia])),$n);
		mysql_query("update camaras set cam_id_provincia='$x' where id_camara='$dat[id_camara]'");echo mysql_error();
		echo "$dat[provincia] - $x <br>";
	}
}


function ciuCam()
{

	
	$sql="select *  from camaras where cam_id_ciudad is NULL limit 1";
	$query=mysql_query($sql);  echo mysql_error();
	while($dat=mysql_fetch_array($query))
	{
		?>
        <div style="color:"><?= $dat[cam_nombre]?><br />Provincia: <b><?=$dat[provincia];?></b> - Ciudad: <b><?= $dat[ciudad]?></b></div>
        <div id="" style="width:600px; margin: 0 0 3px 5px">
   		<div style="height:25px;margin-top:10px; line-height:25px; vertical-align: text-bottom">
     	
        <form action="importacion_camaras.php" method="get">
          <input type="text" id="idcam"  value="<?= $dat[id_camara]?>" name="idcam"  size="5"/>

        <span style="font-size:12px; float:left;">Búsqueda por Ubicación</span>
   	  	<span style="float:right; position:relative; *top: -4px">
  <select name="provincia" id="provincia" onchange="pushcity2()" style="padding:2px; font-size:12px">
  <option value="0" >< Todas las Provincias ></option>
    <?
	$sql="select * from d_provincia";
	$query=mysql_query($sql);
	while($dat=mysql_fetch_array($query))
	echo '<option value="'.$dat[id_provincia].'">'.utf8_encode($dat[desc_provincia]).'</option>';
	?>
    </select>

  <select name="ciudad" id="ciudad" style="padding:2px;font-size:12px">
    <option value="0">< Todas las Ciudades ></option>
  </select>
  <input type="submit" value="Cambiar" style="padding:2px; margin-right:0px" title="Buscar"/></span>
        </form>
  </div>
</div>
        
        <?


		/*$q=mysql_query("select * from d_ciudad where id_provincia='$dat[cam_id_provincia]'");
		while($d=mysql_fetch_array($q))
		{
			$a=strtolower(qacentos(trim($d[desc_ciudad])));
			$b=strtolower(qacentos(trim($dat[ciudad]))); echo "$a - $b<br>"; 
			if($a==$b) 
			{
				mysql_query("update camaras_temp set cam_id_ciudad='$d[id_ciudad]' where id_camara='$dat[id_camara]'");
				echo mysql_error();
				echo "------------------------------------------> $dat[ciudad] - $d[id_ciudad] <br>";
		
			}
		}*/
		
	}
}

function in_camaras()
{
						mysql_query("delete  from camaras");
						$ar="federaciones.txt";
						$f=filesize($ar);
						
						$fop=fopen($ar,"r");
						$texto=fread($fop,$f);
						
						$texto=explode("\r",$texto);
						
						foreach($texto as $key=>$val)
						{
							if($key>0)
							{
								$a=explode(";",$val);
								$x=explode("-",$a[0]);
								
								$a=ttrim($a);
								$x=ttrim($x);
								
								$tel=$a[9];
								$a[3]=trim(str_replace("N°","",$a[3]));
								if($a[10]>'') $tel.=" - $a[10]";
								
								$sql="insert into camaras set 
										
										cam_nombre='$x[0]',
										cam_abreviacion='$x[1]',
										cam_calle='$a[2]',
										cam_calle_numero='$a[3]',
										cam_of='".$a[4]." ".$a[5]."',
										ciudad='$a[7]',
										provincia='$a[8]',
										cam_telefono='$tel',
										cam_fax='$a[11]',
										cam_email='$a[12]',
										cam_web='$a[13]',
										cam_cp='$a[6]'";
										
										//echo $sql;
										
										mysql_query(utf8_encode($sql));
								
								
							}
						}
} // end in_camaras

		//in_camaras();
		//corregir_datos();
		//provCam();
		ciuCam();
		
		
 		 
		 


?>
</body>
</head></html>