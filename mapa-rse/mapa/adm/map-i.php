<? include_once("init.php");


$campo=($_GET[fed])?"id_federacion":"id_camara";
$px=($_GET[fed])?"fed_nombre":"cam_nombre";
if($_GET[oper]=="change")
{
	mysql_query("update mapas set point='$_GET[point]' where $campo='$_GET[id]'");
	exit;
}

$sql=($_GET[fed])?"select m.point,m.datos,f.fed_nombre from mapas m inner join federaciones f on f.$campo=m.$campo where m.$campo='$_GET[id]'":"select m.point,m.datos,c.cam_nombre from mapas m inner join camaras c on c.$campo=m.$campo where m.$campo='$_GET[id]'";


$query=mysql_query($sql);
$dat=mysql_fetch_array($query);
$point=str_replace("(","",$dat[point]);
$point=str_replace(")","",$point); 


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>_titulopagina_</title>
<script src="js/jquery.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=<?=$key?>" type="text/javascript"></script>
<script src="../js/googlemap.js"></script>
<script>

$(document).ready(function(){init()});
var marker="";
function init()
{
	map = new GMap2(document.getElementById("mapa")); 
	//var mapControl = new GMapTypeControl();
	//map.addControl(mapControl);
	map.addControl(new GSmallMapControl());
    //map.setCenter(new GLatLng(-40.817813,-63.808594), 3);
    //geocoder = new GClientGeocoder(); 
	
	var point = new GLatLng(<?=$point?>);
	 marker = new GMarker(point,{draggable:true});
	 marker.disableDragging();
	GEvent.addListener(marker, "dragend", function() { 
	var x=marker.getLatLng();
       if(confirm("Desea Establecer esta ubicación ?")) { NewLocation(x); point=x; } else marker.setLatLng(point);
	  // disableDragging();
        });
	map.addOverlay(marker);
	map.setCenter(point, 14);
	
	GEvent.addListener(marker, "dragstart",function(){marker.closeInfoWindow();}); 
	
}

function NewLocation(x)
{
	var url="map-i.php";
	var pars="id=<?=$_GET[id]?>&point="+x+"&oper=change&fed=<?=$_GET[fed]?>";
	$.get(url,pars,function(a){});
}

function reubicar()
{

	marker.openInfoWindowHtml("<span style='font-family: arial; font-size:12px; color:#333'>Ahora puede mover<br>la marca de posición<br>a su nueva ubicación.</span>", {maxWidth: '250'});
	marker.enableDragging();
}
</script>

</head>

<body style="margin:0; padding:0">
<div style="font-size:14px; font-family:Arial; font-weight:bold; color:#333; margin-bottom:5px; overflow:hidden"><?=$dat[$px]?></div>
<div style="font-size:12px; font-family:Arial; font-weight:normal; color:#666; margin-bottom:5px;overflow:hidden"><?=$dat[datos]?></div>
<div id="mapa" style="width:500px; height:325px; margin:0px; padding:0; border-bottom:2px solid #888;border-top:2px solid #888"></div>
<div id="submapa" style="font-size:11px; font-family:Tahoma; padding:4px; width:492px">
                  
    
                        <div style=" white-space:pre; line-height:8px" align="right">
                          <a href="#" onclick="map.setMapType(G_SATELLITE_MAP);return false;">Vista de Satelite</a>  |  <a href="#" onclick="map.setMapType(G_NORMAL_MAP);return false;">Vista de Mapa</a>  |  <a href="#" onclick="reubicar(); return false;">Reubicar</a>  |  <a href="#" onclick="parent.cerrarmapa(); return false;">Cerrar</a></div>
</div>
</body>
</html>
