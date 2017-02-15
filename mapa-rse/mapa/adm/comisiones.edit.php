<? include("vuelta.php"); include_once("../db.php");
if($perm->listas!=2) exit;
$campo=($_GET[fed])?"id_federacion":"id_camara";
if($_POST[oper]=='del')
{
	$x=explode(",",$_POST[id]);
	foreach($x as $val)
	$query=mysql_query("delete from comisiones where id_com='$val'");
}
if($_POST[oper]=='add')
{
	$sql="insert into comisiones set nombre='$_POST[nombre]',$campo='$_GET[id]',cargo='$_POST[cargo]',email='$_POST[email]'";
	$query=mysql_query($sql);
	if($query) return true;
}
if($_POST[oper]=='edit')
{
	$sql="update comisiones set nombre='$_POST[nombre]',$campo='$_GET[id]',cargo='$_POST[cargo]',email='$_POST[email]',foto='$_POST[foto]',orden='$_POST[orden]' where id_com='$_POST[id]'";
	$query=mysql_query($sql);
	if($query) return true;
}
?>