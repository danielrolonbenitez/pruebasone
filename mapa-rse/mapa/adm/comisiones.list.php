<?
include("../db.php");
$campo=($_GET[fed])? "id_federacion":"id_camara";
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;
$query = mysql_query("SELECT COUNT(*) AS count FROM comisiones where $campo='$_GET[id]'");
$dat = mysql_fetch_array($query);
$count = $row['count'];
if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$sql = "select id_com,nombre,cargo,email from comisiones where $campo='$_GET[id]' ";
$query = mysql_query($sql); echo mysql_error();
while($dat=mysql_fetch_array($query)) 
{
    $responce->rows[$i]['id']=$row[id];
    $responce->rows[$i]['cell']=array($dat[id_com],$dat[nombre],$dat[cargo],$dat[email]);
    $i++;
}    
echo json_encode($responce);?>