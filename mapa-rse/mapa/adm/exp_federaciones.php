<? include_once("init.php");?><?
if(!$perm->exportaciones) {exit; }
$csva="Registro N°;Nombre;Sigla;Calle;Calle N°;Dto-Of;ID Ciudad;Ciudad;Código Postal;ID Provincia;Provincia;Teléfono;Fax;Email;Web;Descripcion;\n";
   
   
    $x= "id_camara;cam_nombre;cam_abreviacion;cam_calle;cam_calle_numero;cam_of;cam_id_ciudad;ciudadx;cam_cp;cam_id_provincia;provinciax;cam_telefono;cam_fax;cam_email;cam_web;cam_descripcion;";
	
   $sql=	"select f.*, ci.desc_ciudad ciudadx, p.desc_provincia provinciax from federaciones f ".
   			"left join d_ciudad ci on ci.id_ciudad=f.fed_id_ciudad ".
			"left join d_provincia p on p.id_provincia=f.fed_id_provincia";
			
   
        
   $query=mysql_query($sql); echo mysql_error();
   while($dat=mysql_fetch_assoc($query))
   {
   		foreach($dat as $key=>$val)
		$dat[$key]=str_replace(";",",",$val);
   
   		$csva.="$dat[id_federacion];$dat[fed_nombre]; $dat[fed_abreviacion]; $dat[fed_calle]; $dat[fed_calle_numero]; $dat[fed_of]; $dat[fed_id_ciudad]; ".utf8_encode($dat[ciudadx])."; $dat[cam_cp]; $dat[fed_id_provincia]; ".utf8_encode($dat[provinciax])."; $dat[fed_telefono];$dat[fed_fax];$dat[fed_email];$dat[fed_web];$dat[fed_descripcion];\n";
   }
	
  header("Content-type: application/vnd.ms-excel");
  header("Content-disposition: attachment; filename= federaciones_" . date("Y-m-d").".csv");                               
  echo utf8_decode($csva);
  exit;  
   
?>