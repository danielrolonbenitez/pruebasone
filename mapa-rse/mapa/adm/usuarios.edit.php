<? include("vuelta.php"); include("../db.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="js/jquery.js"></script>


</head>

<body>


<? 
/*
$fop=fopen("texto.html","w+");
foreach($_POST as $key=>$val)
$t.="$key -> $val<br>";
*/

if($_POST[oper]=='del')
{
	$x=explode(",",$_POST[id]);
	foreach($x as $val)
	{
	$query=mysql_query("delete from usuarios where id_usuario='$val' and nivel!='1'");
	$query=mysql_query("select * from usuarios where id_usuario='$val'");
	$dat=mysql_fetch_assoc($query);
	if($dat[nivel]!='1') $query=mysql_query("delete from permisos where id_usuario='$val'");
	}
}



if($_POST[oper]=='add')
{

	$sql="insert into usuarios set nombre='$_POST[nombre]',usuario='$_POST[usuario]',clave='$_POST[clave]',nivel='2'";
	$query=mysql_query($sql); $idd=mysql_insert_id();
	$query=mysql_query("insert into permisos set listas='$_POST[listas]', eventos='$_POST[evento]', presupuestos='$_POST[presupuestos]', exportaciones='$_POST[exportaciones]', id_usuario='$idd'"); $t.=mysql_error();

}



if($_POST[oper]=='edit')
{
	$sql="update  usuarios  set  nombre='$_POST[nombre]',usuario='$_POST[usuario]' ,clave='$_POST[clave]' where id_usuario='$_POST[id_usuario]'";
	$query=mysql_query($sql); $a=mysql_error(); $t.=$a;
	$sql="update  permisos  set  listas='$_POST[listas]', eventos='$_POST[evento]', presupuestos='$_POST[presupuestos]', exportaciones='$_POST[exportaciones]' where id_usuario='$_POST[id]'";
	
	$query=mysql_query("select * from usuarios where id_usuario='$_POST[id]'");
	$dat=mysql_fetch_assoc($query);
	if($dat[nivel]!='1') $query=mysql_query($sql); $a=mysql_error(); $t.=$a;
	
}
/*

fwrite($fop,$t);
fclose($fop);*/
?>
</body>
</html>
