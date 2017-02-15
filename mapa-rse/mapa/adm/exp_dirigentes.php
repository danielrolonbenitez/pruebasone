<? include_once("init.php");?><?
if(!$perm->exportaciones) {exit; }
$csva="Id;Nombre;Apellido;Federacion;Cámara;Provincia;Ciudad;Domicilio;Teléfono;Teléfono Celular; Email;\n";
   
   
   $sql = "select  d.id_dirigente, d.nombre, d.apellido, f.fed_nombre, c.cam_nombre, p.desc_provincia provincia, ci.desc_ciudad ciudad, d.domicilio, d.telefono_fijo, d.telefono_celular, d.email from dirigentes d 
 inner join d_ciudad ci on ci.id_ciudad=d.id_ciudad 
 inner join d_provincia p on p.id_provincia=d.id_provincia 
 left join federaciones f on f.id_federacion=d.id_federacion 
 left join camaras c on c.id_camara=d.id_camara order by d.apellido";
   
        
   $query=mysql_query($sql); echo mysql_error();
   while($dat=mysql_fetch_assoc($query))
   {
   		foreach($dat as $key=>$val)
		$dat[$key]=str_replace(";",",",$val);
   
   		$csva.="$dat[id_dirigente];$dat[nombre];$dat[apellido];$dat[fed_nombre]; $dat[cam_nombre]; $dat[provincia]; $dat[ciudad]; $dat[domicilio]; $dat[telefono_fijo]; $dat[telefono_celular]; $dat[email];\n";
   }
	
  header("Content-type: application/vnd.ms-excel");
  header("Content-disposition: attachment; filename= dirigentes_" . date("Y-m-d").".csv");                               
  echo utf8_decode($csva);
  exit;  
   
?>
