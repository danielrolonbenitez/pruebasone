<?
include("../db.php");
error_reporting(0);

/*$fop=fopen("texto.html","w+");
foreach($_GET as $key=>$val)
$t.="$key -> $val<br>";
*/

	$page = $_GET['page']; // get the requested page
	$limit = $_GET['rows']; // get how many rows we want to have into the grid
	$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	$sord = $_GET['sord']; // get the direction
	if(!$sidx) $sidx =1;
	
	if($_GET[searchField]>"")
	{
		$c=$_GET[searchString];
		
		$f=$_GET[searchField];
		if($f=="id") $f="p.id_presupuesto";
		if($f=="ciudad") $f="ciu.desc_ciudad";
		if($f=="provincia") $f="pro.desc_provincia";
		
		if($f=="dirigente") $f="CONCAT(d.nombre,' ',d.apellido) ";
		if($f=="federacion") $f="CONCAT(f.fed_nombre,' - ',f.fed_abreviacion) ";
		if($f=="camara") $f="CONCAT(c.cam_nombre,' - ',c.cam_abreviacion) ";
	
		switch($_GET[searchOper])
		{
		case "eq": $sop=" and $f='$c' "; break;
		case "ne": $sop=" and $f<>'$c' "; break;
		case "lt": $sop=" and $f<'$c' "; break;
		case "le": $sop=" and $f<='$c' "; break;
		case "gt": $sop=" and $f>'$c' "; break;
		case "ge": $sop=" and $f>='$c' "; break;
		
		case "bw": $sop=" and $f LIKE '$c%' "; break;
		case "ew": $sop=" and $f LIKE '%$c' "; break;
		case "cn": $sop=" and $f LIKE '%$c%' "; break;
		}

	}
	
	
switch($_GET[tipo])
{
	
	case "d": // dirigentes

			$sql=	"SELECT COUNT(*) AS count FROM dirigentes d inner join rel_presupuesto r on r.id_dirigente=d.id_dirigente inner join presupuesto p on p.id_presupuesto=r.id_presupuesto";
					
			$query = mysql_query($sql);
			$dat = mysql_fetch_array($query);
			$count = $dat['count'];
			
			if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
			if ($page > $total_pages) $page=$total_pages;
			
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			
			$i=0;
			
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			
			
			$sql=	"SELECT p.id_presupuesto, CONCAT(d.nombre,' ',d.apellido) as nom, ciu.desc_ciudad ciudad, pro.desc_provincia provincia, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join dirigentes d on d.id_dirigente=r.id_dirigente 
			left join d_ciudad ciu on  ciu.id_ciudad=d.id_ciudad 
			left join d_provincia pro on pro.id_provincia=d.id_provincia 
			where  d.id_dirigente=d.id_dirigente $sop ORDER BY $sidx $sord LIMIT $start , $limit";
			
			$t.="<br><br>$sql<br><br>";
			$query = mysql_query($sql); $a= mysql_error();$t.="$a <br>";
			while($dat=mysql_fetch_array($query)) 
			{
				foreach($dat as $key=>$val)
				$responce->rows[$i]['id']=$dat[id];
				$responce->rows[$i]['cell']=array($dat[id_presupuesto],$dat[nom],$dat[provincia],$dat[ciudad],$dat[recaudacion],$dat[presupuesto],fecha_a_php($dat[fecha]),$dat[consumido],$dat[saldo],$dat[pagos]);
				$i++;
			}    
	
	break; //tipo d (dirigentes)	
	
	
	
	case "f": // federaciones

			$sql=	"SELECT COUNT(*) AS count FROM federaciones f inner join rel_presupuesto r on r.id_federacion=f.id_federacion inner join presupuesto p on p.id_presupuesto=r.id_presupuesto";
					
			$query = mysql_query($sql);
			$dat = mysql_fetch_array($query);
			$count = $dat['count'];
			
			if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
			if ($page > $total_pages) $page=$total_pages;
			
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			
			$i=0;
			
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			
			
			$sql=	"SELECT p.id_presupuesto, CONCAT(f.fed_nombre,' - ',f.fed_abreviacion) as nom, ciu.desc_ciudad ciudad, pro.desc_provincia provincia, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join federaciones f on f.id_federacion=r.id_federacion 
			left join d_ciudad ciu on  ciu.id_ciudad=f.fed_id_ciudad 
			left join d_provincia pro on pro.id_provincia=f.fed_id_provincia 
			where  f.id_federacion=f.id_federacion $sop ORDER BY $sidx $sord LIMIT $start , $limit";
			
			$t.="<br><br>$sql<br><br>";
			$query = mysql_query($sql); $a= mysql_error();$t.="$a <br>";
			while($dat=mysql_fetch_array($query)) 
			{
				foreach($dat as $key=>$val)
				$responce->rows[$i]['id']=$dat[id];
				$responce->rows[$i]['cell']=array($dat[id_presupuesto],$dat[nom],$dat[provincia],$dat[ciudad],$dat[recaudacion],$dat[presupuesto],fecha_a_php($dat[fecha]),$dat[consumido],$dat[saldo],$dat[pagos]);
				$i++;
			}    
	
	break; //tipo f (federaciones)	
	
	
	case "c": // federaciones
	

			$sql=	"SELECT COUNT(*) AS count FROM camaras c inner join rel_presupuesto r on r.id_camara=c.id_camara inner join presupuesto p on p.id_presupuesto=r.id_presupuesto";
					
			$query = mysql_query($sql);
			$dat = mysql_fetch_array($query);
			$count = $dat['count'];
			
			if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
			if ($page > $total_pages) $page=$total_pages;
			
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			
			$i=0;
			
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			
			
			$sql=	"SELECT p.id_presupuesto, CONCAT(c.cam_nombre,' - ',c.cam_abreviacion) as nom, pro.desc_provincia provincia , ciu.desc_ciudad ciudad, p.recaudacion, p.presupuesto,p.fecha_aprovacion as fecha,p.consumido,p.saldo,p.pagos_extraordinarios as pagos 
			FROM presupuesto p 	
			inner join rel_presupuesto r on r.id_presupuesto=p.id_presupuesto 
			inner join camaras c on c.id_camara=r.id_camara 
			left join d_ciudad ciu on  ciu.id_ciudad=c.cam_id_ciudad 
			left join d_provincia pro on pro.id_provincia=c.cam_id_provincia 
			where  c.id_camara=c.id_camara $sop ORDER BY $sidx $sord LIMIT $start , $limit";
			
			$t.="<br><br>$sql<br><br>";
			$query = mysql_query($sql); $a= mysql_error();$t.="$a <br>";
			while($dat=mysql_fetch_array($query)) 
			{
				foreach($dat as $key=>$val)
				$responce->rows[$i]['id']=$dat[id];
				$responce->rows[$i]['cell']=array($dat[id_presupuesto],$dat[nom],$dat[provincia],$dat[ciudad],$dat[recaudacion],$dat[presupuesto],fecha_a_php($dat[fecha]),$dat[consumido],$dat[saldo],$dat[pagos]);
				$i++;
			}    
	
	break; //tipo c (camaras)	
	
}

/*



	fwrite($fop,$t);
	fclose($fop); 

*/	


	echo json_encode($responce);?>