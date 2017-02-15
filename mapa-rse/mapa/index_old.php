<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?   
if($_SERVER['HTTP_HOST']=='itaksrv') $key="ABQIAAAABzwwj2BPcqEEtkBy_7rgqBQVdiCgNdIQysLeyjpNPfGWFogrIRRToWe3zX6FwGkxaZljc0mJX2P0Gw";
else $key="ABQIAAAABzwwj2BPcqEEtkBy_7rgqBTvy9_hysg2goQYp-spJcQPceQhIhQeyAWV9J4R6fVmpdKxCbkBYwKJ0w";
?>


<title>Documento sin t&iacute;tulo</title>
<script src="js/jquery.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=<?=$key?>" type="text/javascript"></script>
<script src="js/googlemap.js"></script>
<script>
	$(document).ready(function(){
	
	initialize('');
	showAddress(map,'San Martin 1200, Santa Rosa, La Pampa ',"<b>Cámara de Comercio de Santa Rosa</b><br>San Martin 1200, Santa Rosa, La Pampa.");
	showAddress(map,'Belgrano 2121, Mar del Plata, Buenos Aires ',"<b>Cámara Marplatense Industrial</b><br>Belgrano 2121, Mar del Plata, Buenos Aires.");
	showAddress(map,'Dorrego 121, San Miguel de Tucuman, Tucuman ',"<b>Cámara Agricola S.M. de Tucumán</b><br>Dorrego 121, San Miguel de Tucuman, Tucumán.");
	showAddress(map,'Rivadavia 785, Bariloche, Neuquen ',"<b>Cámara de Turismo de Bariloche</b><br>Rivadavia 785, Bariloche, Neuquen.");
	
	});


</script>
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="mapa" style="width:500px; height:400px;"></div>
                   <div id="submapa">
                    <span onclick="map.setMapType(G_SATELLITE_MAP);" style="float:left">
                         <a href="#" onclick="return false;">Vista de Satelite</a></span>
                        <span onclick="map.setMapType(G_NORMAL_MAP);" style="float:right">
                        <a href="#" onclick="return false;">Vista de Mapa</a></span>
</div>
               
               
               <div id="lista">
               <ul>
               <li><img src="restore-zoom.png" style="cursor:pointer" onclick="volar('10');"/>&nbsp;&nbsp;  <b>Argentina</b></li>
               	<li><img src="restore-zoom.png" style="cursor:pointer" onclick="volar('1');"/>&nbsp;&nbsp;  <b>Cámara de Comercio de Santa Rosa</b>, Santa Rosa</li>
                <li><img src="restore-zoom.png" style="cursor:pointer" onclick="volar('2')";/>  &nbsp;&nbsp;<b>Cámara Marplatense Industrial</b>, Mar del Plata </li>
                <li><img src="restore-zoom.png" style="cursor:pointer"  onclick="volar('3')";/> &nbsp;&nbsp; <b>Cámara Agricola S.M. de Tucumán</b>, San Miguel de Tucumán</li>
                <li><img src="restore-zoom.png" style="cursor:pointer"  onclick="volar('4');"/> &nbsp;&nbsp; <b>Cámara de Turismo de Bariloche</b>, Bariloche</li>
               </ul>
</div>        


</body>
</html>
