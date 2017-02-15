<? include_once("init.php");?><?
if(!$perm->exportaciones) {exit; }
		
$csva="Id;Colaborador;Provincia;Ciudad;Recaudación;Presupuesto;Fecha de Aprobación;Consumido;Saldo;Pagos Extraordinarios;\n";
   
   
/* $sql=	"SELECT p.id_presupuesto, CONCAT(d.nombre,' ',d.apellido) as nom,p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join dirigentes d on d.id_dirigente=r.id_dirigente 
			where  d.id_dirigente=d.id_dirigente order by nom";*/
	
		 $sql=	"SELECT p.id_presupuesto, CONCAT(d.nombre,' ',d.apellido) as nom, ciu.desc_ciudad ciudad, pro.desc_provincia provincia, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join dirigentes d on d.id_dirigente=r.id_dirigente 
			left join d_ciudad ciu on  ciu.id_ciudad=d.id_ciudad 
			left join d_provincia pro on pro.id_provincia=d.id_provincia 
			where  d.id_dirigente=d.id_dirigente order by nom";
   
        
   $query=mysql_query($sql); echo mysql_error();
   while($dat=mysql_fetch_assoc($query))
   {
   		foreach($dat as $key=>$val)
		$dat[$key]=str_replace(";",",",$val);
   		$csva.="$dat[id_presupuesto];$dat[nom];$dat[provincia];$dat[ciudad];$dat[recaudacion];$dat[presupuesto];$dat[fecha];$dat[consumido];$dat[saldo];$dat[pagos];\n";
   }
	
  header("Content-type: application/vnd.ms-excel");
  header("Content-disposition: attachment; filename= presupuesto_dirigentes_" . date("Y-m-d").".csv");                               
  echo utf8_decode($csva);
  exit;  
   
?>
