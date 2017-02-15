<?
include("../db.php");
error_reporting(0);
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
	
	$search.=($_GET[cam_nombre])? " and c.cam_nombre like '%$_GET[cam_nombre]%'":'';
	$search.=($_GET[id_camara])? " and c.id_camara like '%$_GET[id_camara]%'":'';
	$search.=($_GET[cam_abreviacion])? "and c.cam_abreviacion like '%$_GET[cam_abreviacion]%'":'';
	$search.=($_GET[provincia])? " and p.desc_provincia like '%$_GET[provincia]%'":'';
	$search.=($_GET[ciudad])? " and ci.desc_ciudad like '%$_GET[ciudad]%'":'';
}
$query = mysql_query("SELECT COUNT(*) AS count FROM camaras c inner join d_ciudad ci on ci.id_ciudad=c.cam_id_ciudad inner join d_provincia p on p.id_provincia=c.cam_id_provincia WHERE c.cam_eliminado!='1'");
$dat = mysql_fetch_array($query);
$count = $dat['count'];
if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$sql = "select c.id_camara, c.cam_nombre, c.cam_abreviacion, f.fed_abreviacion federacion, p.desc_provincia provincia , ci.desc_ciudad ciudad, c.cam_calle, c.cam_calle_numero, c.cam_of, c.cam_telefono,c.cam_fax, c.cam_email, c.cam_web, c.cam_descripcion, c.mapa_estado from camaras c
 inner join d_ciudad ci on ci.id_ciudad=c.cam_id_ciudad 
 inner join d_provincia p on p.id_provincia=c.cam_id_provincia 
 left join rel_cam_fed rel on rel.id_camara=c.id_camara 
 left join federaciones f on rel.id_federacion=f.id_federacion where c.cam_eliminado!='1' $search ORDER BY $sidx $sord LIMIT $start , $limit";
$query = mysql_query($sql); echo mysql_error();
while($dat=mysql_fetch_array($query)) 
{
 	foreach($dat as $key=>$val)
    $responce->rows[$i]['id']=$dat[id];
    $responce->rows[$i]['cell']=array($dat[id_camara],utf8_decode($dat[cam_nombre]),$dat[cam_abreviacion],$dat[federacion],utf8_encode($dat[provincia]),utf8_decode($dat[ciudad]),utf8_decode($dat[cam_calle]),$dat[cam_calle_numero],utf8_decode($dat[cam_of]),$dat[cam_telefono],$dat[cam_fax],$dat[cam_email],$dat[cam_web],$dat[cam_descripcion],$dat[mapa_estado]);
    $i++;
}    
/*
$t="hola".$search;
fwrite($fop,$t);
fclose($fop); 
*/
echo json_encode($responce);?>