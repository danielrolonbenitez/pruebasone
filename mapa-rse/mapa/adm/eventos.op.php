<?include_once("init.php");
$query=mysql_query("select id_camara id,cam_nombre nombre from camaras order by cam_nombre");
while($dat=mysql_fetch_array($query))
if($dat[nombre]>'') 
$items[$dat[nombre]]="$dat[id]-1";
$query=mysql_query("select id_federacion id,fed_nombre nombre from federaciones order by fed_nombre");
while($dat=mysql_fetch_array($query))
if($dat[nombre]>'') $items[$dat[nombre]]="$dat[id]-0";
foreach ($items as $key=>$value) 
		{
		if (strpos(strtolower($key), $q) !== false) 
		echo "$key|$value\n";
		}
?>