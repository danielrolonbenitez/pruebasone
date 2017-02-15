<?
include("../db.php");
error_reporting(0);
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;
if($_GET[_search]==true)
{
	
	$search.=($_GET[fed_nombre])? " and f.fed_nombre like '%$_GET[fed_nombre]%'":'';
	$search.=($_GET[id_federacion])? " and f.id_federacion like '%$_GET[id_federacion]%'":'';
	$search.=($_GET[fed_abreviacion])? "and f.fed_abreviacion like '%$_GET[fed_abreviacion]%'":'';
	$search.=($_GET[provincia])? " and p.desc_provincia like '%$_GET[provincia]%'":'';
	$search.=($_GET[ciudad])? " and ci.desc_ciudad like '%$_GET[ciudad]%'":'';
}
$query = mysql_query("SELECT COUNT(*) AS count FROM federaciones f inner join d_ciudad ci on ci.id_ciudad=f.fed_id_ciudad inner join d_provincia p on p.id_provincia=f.fed_id_provincia WHERE f.fed_eliminado!='1'");
$dat = mysql_fetch_array($query);
$count = $dat['count'];
if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$sql = "select f.id_federacion, f.fed_nombre, f.fed_abreviacion,  p.desc_provincia provincia , ci.desc_ciudad ciudad, f.fed_calle, f.fed_calle_numero, f.fed_of, f.fed_telefono,f.fed_fax, f.fed_email, f.fed_web, f.fed_descripcion, f.mapa_estado from federaciones f 
 inner join d_ciudad ci on ci.id_ciudad=f.fed_id_ciudad 
 inner join d_provincia p on p.id_provincia=f.fed_id_provincia 
 where f.fed_eliminado!='1' $search ORDER BY $sidx $sord LIMIT $start , $limit";
$query = mysql_query($sql); echo mysql_error();
while($dat=mysql_fetch_array($query)) 
{
    $responce->rows[$i]['id']=$dat[id];
    $responce->rows[$i]['cell']=array($dat[id_federacion],utf8_decode($dat[fed_nombre]),$dat[fed_abreviacion],utf8_decode($dat[provincia]),utf8_decode($dat[ciudad]),utf8_decode($dat[fed_calle]),$dat[fed_calle_numero],utf8_decode($dat[fed_of]),$dat[fed_telefono],$dat[fed_fax],$dat[fed_email],$dat[fed_web],$dat[fed_descripcion],$dat[mapa_estado]);
    $i++;
}    
/*
$t="hola".$search;
fwrite($fop,$t);
fclose($fop); 
*/
echo json_encode($responce);?>