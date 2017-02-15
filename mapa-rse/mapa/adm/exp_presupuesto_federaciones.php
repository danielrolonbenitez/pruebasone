<? include_once("init.php");?><?
if(!$perm->exportaciones) {exit; }
		
$csva="Id;Federación;Provincia;Ciudad;Recaudación;Presupuesto;Fecha de Aprobación;Consumido;Saldo;Pagos Extraordinarios;\n";
   
   
/* $sql=	"SELECT p.id_presupuesto, CONCAT(f.fed_nombre,' - ',f.fed_abreviacion) as nom,p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join federaciones f on f.id_federacion=r.id_federacion  order by f.fed_nombre ";*/
			
    $sql=	"SELECT p.id_presupuesto, CONCAT(f.fed_nombre,' - ',f.fed_abreviacion) as nom, ciu.desc_ciudad ciudad, pro.desc_provincia provincia, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join federaciones f on f.id_federacion=r.id_federacion 
			left join d_ciudad ciu on  ciu.id_ciudad=f.fed_id_ciudad 
			left join d_provincia pro on pro.id_provincia=f.fed_id_provincia order by f.fed_nombre ";
			
        
   $query=mysql_query($sql); echo mysql_error();
   while($dat=mysql_fetch_assoc($query))
   {
   		foreach($dat as $key=>$val)
		$dat[$key]=str_replace(";",",",$val);
   		$csva.="$dat[id_presupuesto];$dat[nom];$dat[provincia];$dat[ciudad];$dat[recaudacion];$dat[presupuesto];$dat[fecha];$dat[consumido];$dat[saldo];$dat[pagos];\n";
   }
	
  header("Content-type: application/vnd.ms-excel");
  header("Content-disposition: attachment; filename= presupuesto_federaciones_" . date("Y-m-d").".csv");                               
  echo utf8_decode($csva);
  exit;  
   
?>
