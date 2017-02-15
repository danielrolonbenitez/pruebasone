<? include("vuelta.php"); include_once("../db.php");
if($perm->eventos!=2) exit;
$campo=($_GET[iscam])?"id_camara":"id_federacion";
if($_POST[oper]=='del')
{
	$x=explode(",",$_POST[id]);
	foreach($x as $val)
	$query=mysql_query("delete from eventos where id_evento='$val'");
}
if($_POST[oper]=='add')
{
	$f=split("/",$_POST[fecha]);
	$f2=$f[2]."-".$f[1]."-".$f[0];
	$sql="insert into eventos set $campo='$_GET[idcam]',id_categoria='$_POST[categoria]', titulo='$_POST[titulo]',desc_corta='$_POST[texto_corto]',desc_larga='$_POST[texto_largo]',fecha='$f2',hora='$_POST[horario]', lugar='$_POST[lugar]',link='$_POST[link]',img='$_POST[img]',nota='$_POST[nota]'";
	$query=mysql_query($sql);
	if($query) return true;
}
if($_POST[oper]=='edit')
{
$fop=fopen("texto.html","w+");
foreach($_POST as $key=>$val)
$t.="$key -> $val<br>";
fwrite($fop,$t);
fclose($fop);
	$f=split("/",$_POST[fecha]);
	$f2=$f[2]."-".$f[1]."-".$f[0];
	$sql="update eventos set $campo='$_GET[idcam]',id_categoria='$_POST[categoria]', titulo='$_POST[titulo]',desc_corta='$_POST[texto_corto]',desc_larga='$_POST[texto_largo]',fecha='$f2',hora='$_POST[horario]', lugar='$_POST[lugar]',link='$_POST[link]',img='$_POST[img]',nota='$_POST[nota]' where id_evento='$_POST[id]'";
	$query=mysql_query($sql);
	if($query) return true;
}
?>