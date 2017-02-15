<? include_once("init.php");
if(!$perm->presupuestos) { header("location: index.php");exit; }
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
<script src="js/lista_presu_camaras.js"></script>

</head>

<body style="overflow: hidden; margin:0; padding:0 ">
<input type="hidden" id="permPresupuestos" value="<?=$perm->presupuestos?>" />
<?
// agregamos los registros inexistentes

$query=mysql_query("select c.id_camara id from camaras c WHERE NOT EXISTS (select r.id_camara from rel_presupuesto r where r.id_camara=c.id_camara)");  echo mysql_error();
while ($dat=mysql_fetch_array($query))
{
	mysql_query("insert into presupuesto set recaudacion='0'"); $idd=mysql_insert_id();
	mysql_query("insert into rel_presupuesto set id_presupuesto='$idd', id_camara='$dat[id]'");	
}

?>
<a href="video.html" style="display:none" id="video" rel='facebox'>sss</a>
<?= $campos;?>

<? include_once("panel.php");?>

<div class="containergral_vacio" align="center"><br />
 
          <table id="list2" class="scroll" cellpadding="0" cellspacing="0"></table>
            <div id="pager2" class="scroll" style="text-align:center;"></div>
</div>
</body>
</html>
