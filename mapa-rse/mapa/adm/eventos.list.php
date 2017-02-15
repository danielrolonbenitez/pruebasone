<?
include("../db.php");
error_reporting(0);
$campo=($_GET[iscam])?"id_camara":"id_federacion";
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;

$query = mysql_query("SELECT COUNT(*) AS count FROM eventos where id_camara='$_GET[id]'");
$dat = mysql_fetch_array($query);
$count = $row['count'];

if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

$i=0;

$start = $limit*$page - $limit; // do not put $limit*($page - 1)


$sql = "select e.id_evento,e.id_categoria, e.titulo,e.fecha,e.hora,e.lugar,e.desc_corta,e.desc_larga,e.link,e.img,e.nota from eventos e  where e.$campo='$_GET[id]' ";

$query = mysql_query($sql); echo mysql_error();
while($dat=mysql_fetch_array($query)) 
{
    $responce->rows[$i]['id']=$row[id];
	if($dat[id_categoria]==1) $categoria=utf8_encode("Sensibilización");
	if($dat[id_categoria]==2) $categoria=utf8_encode("Capacitación");
	if($dat[id_categoria]==3) $categoria=utf8_encode("Asistencia");
	
	$f=split("-",$dat[fecha]);
	$f=$f[2]."/".$f[1]."/".$f[0];
    $responce->rows[$i]['cell']=array($dat[id_evento],$categoria,$dat[titulo],$f,$dat[hora],$dat[lugar],$dat[desc_corta],$dat[desc_larga],$dat[link],$dat[img],$dat[nota]);
    $i++;
}    


echo json_encode($responce);?>