<?
include("../db.php");
/*
$fop=fopen("texto.html","w+");
foreach($_GET as $key=>$val)
$t.="$key -> $val<br>";
*/
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;
if($_GET[_search]==true)
{
	
	$search.=($_GET[nombre])? " and d.nombre like '%$_GET[nombre]%'":'';
	$search.=($_GET[apellido])? " and d.apellido like '%$_GET[apellido]%'":'';
	$search.=($_GET[camara])? " and c.cam_nombre like '%$_GET[camara]%'":'';
	$search.=($_GET[federacion])? "and f.fed_nombre like '%$_GET[federacion]%'":'';
	$search.=($_GET[provincia])? " and p.desc_provincia like '%$_GET[provincia]%'":'';
	$search.=($_GET[ciudad])? " and ci.desc_ciudad like '%$_GET[ciudad]%'":'';
}
$query = mysql_query("SELECT COUNT(*) AS count FROM dirigentes d inner join d_ciudad ci on ci.id_ciudad=d.id_ciudad inner join d_provincia p on p.id_provincia=d.id_provincia");
$dat = mysql_fetch_array($query);
$count = $dat['count'];
if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$sql = "select  d.id_dirigente, d.nombre, d.apellido, f.fed_nombre, c.cam_nombre, p.desc_provincia provincia, ci.desc_ciudad ciudad, d.domicilio, d.telefono_fijo, d.telefono_celular, d.email from dirigentes d 
 inner join d_ciudad ci on ci.id_ciudad=d.id_ciudad 
 inner join d_provincia p on p.id_provincia=d.id_provincia 
 left join federaciones f on f.id_federacion=d.id_federacion 
 left join camaras c on c.id_camara=d.id_camara 
 where d.id_dirigente=d.id_dirigente $search ORDER BY $sidx $sord LIMIT $start , $limit";
  /*
$t.="<br><br>$sql";
fwrite($fop,$t);
fclose($fop);
*/
$query = mysql_query($sql); $a= mysql_error();$t.="$a <br>";
while($dat=mysql_fetch_array($query)) 
{
 	foreach($dat as $key=>$val)
    $responce->rows[$i]['id']=$dat[id];
    $responce->rows[$i]['cell']=array($dat[id_dirigente],$dat[nombre],$dat[apellido],$dat[fed_nombre],$dat[cam_nombre],utf8_encode($dat[provincia]),utf8_encode($dat[ciudad]),$dat[domicilio],$dat[telefono_fijo],$dat[telefono_celular],$dat[email]);
    $i++;
	
	
}    
/*
$t="hola".$search;
fwrite($fop,$t);
fclose($fop); 
*/
echo json_encode($responce);?>