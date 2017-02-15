<?
error_reporting(0);
 include("vuelta.php"); include("../db.php");
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
//$fop=fopen("texto.html","w+");
/*foreach($_POST as $key=>$val)
$t.="$key -> $val<br>";
*/
if($_POST[oper]=='del')
{
	$x=explode(",",$_POST[id]);
	foreach($x as $val)
	{
	$query=mysql_query("delete from camaras where id_camara='$val'");
	$query=mysql_query("delete from rel_cam_fed where id_camara='$val'");
	$query=mysql_query("delete from comisiones where id_camara='$val'");
	}
}
if($_POST[oper]=='add')
{
	$sql="insert into camaras set cam_nombre='".utf8_encode($_POST['cam_nombre'])."', cam_abreviacion='$_POST[cam_abreviacion]', cam_calle='$_POST[cam_calle]',cam_calle_numero='$_POST[cam_calle_numero]', cam_of='$_POST[cam_of]',cam_id_ciudad='$_POST[ciudad]',cam_id_provincia='$_POST[provincia]',cam_telefono='$_POST[cam_telefono]',cam_fax='$_POST[cam_fax]',cam_email='$_POST[cam_email]',cam_web='$_POST[cam_web]',cam_eliminado='0', cam_suspendido='0',cam_descripcion='$_POST[cam_descripcion]',mapa_estado='0'";
	$query=mysql_query($sql); $idd=mysql_insert_id();
	
	if($_POST[federacion]>0)
	{
	$sql="insert into rel_cam_fed set id_camara='$idd', id_federacion='$_POST[federacion]'";
	$query=mysql_query($sql); 
	}	
}
if($_POST[oper]=='edit')
{
	$sql="update  camaras set cam_nombre='".utf8_encode($_POST['cam_nombre'])."', cam_abreviacion='$_POST[cam_abreviacion]', cam_calle='$_POST[cam_calle]',cam_calle_numero='$_POST[cam_calle_numero]', cam_of='$_POST[cam_of]',cam_id_ciudad='$_POST[ciudad]',cam_id_provincia='$_POST[provincia]',cam_telefono='$_POST[cam_telefono]',cam_fax='$_POST[cam_fax]',cam_email='$_POST[cam_email]',cam_web='$_POST[cam_web]',cam_eliminado='0', cam_suspendido='0',cam_descripcion='$_POST[cam_descripcion]',mapa_estado='0' where id_camara='$_POST[id]'";
	$query=mysql_query($sql);
	
	$query=mysql_query("delete from rel_cam_fed where id_camara='$_POST[id]'");
	
	if($_POST[federacion]>0)
	$sql="insert into rel_cam_fed set id_camara='$_POST[id]', id_federacion='$_POST[federacion]'";
	$query=mysql_query($sql); 
	
}
//fwrite($fop,$t);
//fclose($fop);
?>
</body>
</html>
