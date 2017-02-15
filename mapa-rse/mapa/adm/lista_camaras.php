<? include_once("init.php");?><?

if(!$perm->listas) { header("location: index.php");exit; }

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

<? if($paramapear>0 or 1==1) {
// esta realizado para cargar el api de google solo si hay registros sin actualizar mapa... 
// crea inputs hidden con la info que despues recogerá la funcion getInfoForMap.
?>

<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=<?=_key_?>"></script><? 

//$query=mysql_query("update camaras set mapa_estado='0' where cam_id_provincia='25'");

	$query=mysql_query("select  cam.*,c.desc_ciudad ciudad,p.desc_provincia provincia  from camaras cam left join d_ciudad c on cam.cam_id_ciudad=c.id_ciudad left join d_provincia p on p.id_provincia=cam.cam_id_provincia where mapa_estado='0' or mapa_estado='2'");
	while($dat=mysql_fetch_array($query))
	{
	$id=$dat[id_camara]; 
	$x=($dat[provincia]!='Capital Federal') ? utf8_encode("$dat[ciudad],"): "";
	$direccion="$dat[cam_calle] $dat[cam_calle_numero], $x ".utf8_encode($dat[provincia]).", Argentina";
	$campos.="<input type='hidden' name='$id' class='paramapear' value='$direccion'>";
	}
} ?>

<script src="js/panel.js"></script>
<script src="js/ciudades.js"></script>
<script src="js/lista_camaras.js"></script>
<script>var opFederaciones='<?=$listafederaciones?>';</script>
</head>

<body style="overflow: hidden; margin:0; padding:0 ">
<input type="hidden" id="permListas" value="<?=$perm->listas?>" />
<a href="video.html" style="display:none" id="video" rel='facebox'>sss</a>
<?= $campos;?>

<? include_once("panel.php");?>
<div class="containergral_vacio">
 

                
          <table id="list2" class="scroll" cellpadding="0" cellspacing="0"></table>
            <div id="pager2" class="scroll" style="text-align:center;"></div>
</div>
<script>
	$(document).ready(function(){
		getInfoForMap();
	});
</script>
</body>
</html>
