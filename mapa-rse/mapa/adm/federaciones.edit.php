<? include("vuelta.php"); include("../db.php");if($perm->eventos!=2) exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="js/jquery.js"></script>
</head>
<body>
<? 
if($_POST[oper]=='del')
{
	$x=explode(",",$_POST[id]);
	foreach($x as $val)
	{
	$query=mysql_query("delete from federaciones where id_federacion='$val'");
	$query=mysql_query("delete from rel_fed_fed where id_federacion='$val'");
	$query=mysql_query("delete from comisiones where id_federacion='$val'");
	}
}
if($_POST[oper]=='add')
{
	$sql="insert into federaciones set fed_nombre='$_POST[fed_nombre]', fed_abreviacion='$_POST[fed_abreviacion]', fed_calle='$_POST[fed_calle]',fed_calle_numero='$_POST[fed_calle_numero]', fed_of='$_POST[fed_of]',fed_id_ciudad='$_POST[ciudad]',fed_id_provincia='$_POST[provincia]',fed_telefono='$_POST[fed_telefono]',fed_fax='$_POST[fed_fax]',fed_email='$_POST[fed_email]',fed_web='$_POST[fed_web]',fed_eliminado='0', fed_suspendido='0',fed_descripcion='$_POST[fed_descripcion]',mapa_estado='0'";
	$query=mysql_query($sql);
	
}
if($_POST[oper]=='edit')
{
	$sql="update  federaciones set fed_nombre='$_POST[fed_nombre]', fed_abreviacion='$_POST[fed_abreviacion]', fed_calle='$_POST[fed_calle]',fed_calle_numero='$_POST[fed_calle_numero]', fed_of='$_POST[fed_of]',fed_id_ciudad='$_POST[ciudad]',fed_id_provincia='$_POST[provincia]',fed_telefono='$_POST[fed_telefono]',fed_fax='$_POST[fed_fax]',fed_email='$_POST[fed_email]',fed_web='$_POST[fed_web]',fed_eliminado='0', fed_suspendido='0',fed_descripcion='$_POST[fed_descripcion]',mapa_estado='0' where id_federacion='$_POST[id]'";
	$query=mysql_query($sql);
}
?>
</body>
</html>
