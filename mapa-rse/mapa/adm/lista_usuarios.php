<? include_once("init.php");?><?




/* lista federaciones */
$query=mysql_query("select id_federacion id, fed_abreviacion ab, fed_nombre nombre from federaciones order by 2"); echo mysql_error();
while($dat=@mysql_fetch_array($query))
{
	$listafederaciones.="$dat[id]:$dat[ab];";
}


$listafederaciones="0:Sin Federación;".$listafederaciones;
$listafederaciones=substr($listafederaciones,0,-1);

$query=mysql_query("select COUNT(*) count from camaras where mapa_estado='0'");
$dat=mysql_fetch_array($query); $paramapear=$dat[count];  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_titulopagina_?></title>
<link href="images/panel.css" rel="stylesheet" type="text/css" />
<link href="adm.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="plugins/jquery.jqGrid-3.5.1/css/jquery-ui-1.7.2.custom.css"/>-->
<link rel="stylesheet" type="text/css" href="plugins/jquery.jqGrid-3.5.1/css/jquery-ui-1.7.2.custom.css"/>
<link rel="stylesheet" type="text/css" href="plugins/jquery.jqGrid-3.5.1/css/ui.jqgrid.css"/> 
<link href="plugins/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script>var iscam=true;</script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery-1.3.2.min.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery-ui-1.7.1.custom.min.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/i18n/grid.locale-sp.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery.jqGrid.min.js"></script>
<script src="js/jquery.dropshadow.js"></script>
<script src="plugins/facebox/facebox.js"></script>
<!--<script src="plugins/jquery.jqGrid-3.5.1/src/grid.celledit.js"></script>-->
<script src="js/mapas.js"></script>

<script src="js/panel.js"></script>
<script src="js/ciudades.js"></script>
<script src="js/lista_usuarios.js"></script>



</head>

<body style="overflow: hidden; margin:0; padding:0 ">
<a href="video.html" style="display:none" id="video" rel='facebox'>sss</a>
<?= $campos;?>

<? include_once("panel.php");?>
<br />

<div class="containergral_vacio" align="center">
 

                
          <table id="list2" class="scroll" cellpadding="0" cellspacing="0"></table>
            <div id="pager2" class="scroll" style="text-align:center;"></div>
</div>
</body>
</html>
