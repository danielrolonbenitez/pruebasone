<?  include_once("../db.php");    include_once("vuelta.php");
http://redcame.org.ar/mapa/adm/mapa.op.php?id=7049&address=El%20Salvador%204577,%20%20Capital%20Federal,%20Argentina&point=(-34.5903319,%20-58.42556000000002)&oper=add&fed=0
$id = $_GET['id'];
$address = $_GET['address'];
$point = $_GET['point'];
$oper = $_GET['oper'];
$campo=($_GET[fed])?"id_federacion":"id_camara";
$dbase=($_GET[fed])?"federaciones":"camaras";

		if($oper=="add")
		{
		//	echo "delete from mapas where $campo='$id'";
		mysql_query("delete from mapas where $campo='$id'");
		mysql_query("insert into mapas set $campo='$id',datos='$address',point='$point'");
		//echo "insert into mapas set $campo='$id',datos='$address',point='$point'";
		$est=($point=='null')? 2:1;
		mysql_query("update $dbase set mapa_estado='$est' where $campo='$id'");
		//echo "update $dbase set mapa_estado='$est' where $campo='$id'";
		}
		
		if($oper=="reload")
		{
			mysql_query("update $dbase set mapa_estado='0' where id_camara='$id'");
		}
?>
