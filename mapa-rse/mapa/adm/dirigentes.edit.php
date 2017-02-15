<? include("vuelta.php");  include_once("../db.php");
if($perm->listas!=2) exit;
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
	$query=mysql_query("delete from dirigentes where id_dirigente='$val'");
	}
}
if($_POST[oper]=='add')
{
	$sql="insert into dirigentes set nombre='$_POST[nombre]',apellido='$_POST[apellido]',id_federacion='$_POST[federacion]', id_camara='$_POST[camara]', id_provincia='$_POST[provincia]',id_ciudad='$_POST[ciudad]',domicilio='$_POST[domicilio]',telefono_fijo='$_POST[telefono]',telefono_celular='$_POST[celular]',email='$_POST[email]'";
	$query=mysql_query($sql); $idd=mysql_insert_id();
}
if($_POST[oper]=='edit')
{
	$sql="update  dirigentes set nombre='$_POST[nombre]',apellido='$_POST[apellido]', id_federacion='$_POST[federacion]', id_camara='$_POST[camara]',  id_provincia='$_POST[provincia]',id_ciudad='$_POST[ciudad]', domicilio='$_POST[domicilio]',telefono_fijo='$_POST[telefono]', telefono_celular='$_POST[celular]',email='$_POST[email]' where id_dirigente='$_POST[id]'";
	$query=mysql_query($sql); $a=mysql_error(); $t.=$a;
	
}
/*
fwrite($fop,$t);
fclose($fop);*/
?>
</body>
</html>
