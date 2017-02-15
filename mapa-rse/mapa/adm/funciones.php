<?
function eventosPasadosCount()
{
	$sql="select id_evento from eventos where fecha<='now()'";
	$query=mysql_query($sql); echo mysql_error();
	$row=mysql_num_rows($query); 
	return $row;
}
function eventosFuturosCount()
{
	$sql="select id_evento from eventos where fecha>'now()'";
	$query=mysql_query($sql);
	$row=mysql_num_rows($query);
	return $row;
}
?>