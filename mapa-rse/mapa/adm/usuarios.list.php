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





$query = mysql_query("SELECT COUNT(*) AS count FROM usuarios");
$dat = mysql_fetch_array($query);
$count = $dat['count'];

if( $count >0 ) $total_pages = ceil($count/$limit); else $total_pages = 0;
if ($page > $total_pages) $page=$total_pages;

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

$i=0;

$start = $limit*$page - $limit; // do not put $limit*($page - 1)


$sql = "select u.id_usuario, u.nombre,u.usuario,u.clave,p.listas, p.eventos,p.presupuestos,p.exportaciones from usuarios u inner join permisos p on u.id_usuario=p.id_usuario";


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
    $responce->rows[$i]['cell']=array($dat[id_usuario],$dat[nombre],$dat[usuario],$dat[clave],$dat[listas],$dat[eventos],$dat[presupuestos],$dat[exportaciones]);
    $i++;
	
	

}    


/*
$t="hola".$search;
fwrite($fop,$t);
fclose($fop); 
*/
echo json_encode($responce);?>