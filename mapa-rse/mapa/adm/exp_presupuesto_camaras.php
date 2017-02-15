<? include_once("init.php");?><?
if(!$perm->exportaciones) {exit; }
		
$csva="Id;Cámara;Provincia;Ciudad;Recaudación;Presupuesto;Fecha de Aprobación;Consumido;Saldo;Pagos Extraordinarios;\n";
   
   
/* $sql=	"SELECT p.id_presupuesto, CONCAT(c.cam_nombre,' - ',c.cam_abreviacion) as nom,p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join camaras c on c.id_camara=r.id_camara order by c.cam_nombre ";
			*/
   
         $sql=	"SELECT p.id_presupuesto, CONCAT(c.cam_nombre,' - ',c.cam_abreviacion) as nom, pro.desc_provincia provincia , ciu.desc_ciudad ciudad, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join camaras c on c.id_camara=r.id_camara 
			left join d_ciudad ciu on  ciu.id_ciudad=c.cam_id_ciudad 
			left join d_provincia pro on pro.id_provincia=c.cam_id_provincia  order by c.cam_nombre ";
			
			
   $query=mysql_query($sql); echo mysql_error();
   while($dat=mysql_fetch_assoc($query))
   {
   		foreach($dat as $key=>$val)
		$dat[$key]=str_replace(";",",",$val);
   		$csva.="$dat[id_presupuesto];$dat[nom];$dat[provincia];$dat[ciudad];$dat[recaudacion];$dat[presupuesto];$dat[fecha];$dat[consumido];$dat[saldo];$dat[pagos];\n";
   }
	
  header("Content-type: application/vnd.ms-excel");
  header("Content-disposition: attachment; filename= presupuesto_camaras_" . date("Y-m-d").".csv");                               
  echo utf8_decode($csva);
  exit;  
   
?>
