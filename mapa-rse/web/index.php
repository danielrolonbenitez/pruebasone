<?php
require('../clases/MySQL.php');
$MySQL = MySQL::getInstance();
$sql = "SELECT themes.id, themes.theme_name from themes";
$MySQL->setQuery($sql);
$themes = $MySQL->loadObjectList();
$sql = "SELECT districts.id, districts.district_name from districts WHERE id IN (SELECT distinct(district_id) from locations)";
$MySQL->setQuery($sql);
$districts = $MySQL->loadObjectList();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
	<link rel="stylesheet" href="css/colorbox.css" />
	<link rel="stylesheet" href="css/styles.css?ver=1" />
    <script type="text/javascript"
		src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBw5Hr3eezVgqfn2eBxa-yAeXrLktRPH3M&sensor=false">
    </script>
	<script type="text/javascript" 
		src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js">
	</script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
     
    </script>
  </head>
  <body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&appId=1031127900248519&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<!--	<div id="header">
		<div id="logo"></div>
		<h1><span class="hm">Mapa PYME de Responsabilidad Social Empresaria</span><span class="sm">Mapa PYME de RSE</span></h1>
		
	</div>-->
	
	<div id="referencias">
		<ul>
			<li><img src="../img/pointer_1.png" width="9" />RSE Interna</li>
			<li><img src="../img/pointer_2.png" width="9" />Ambiente</li>
			<li><img src="../img/pointer_3.png" width="9" />Comunidad</li>
		</ul>
	</div>
	
     <div id="datos">
		 <div>
			<fieldset>
		  Buscar por Ubicación: <select id="buscarPorProvincia">
		  <option value="default">Todas</option>
		  <?php
			  foreach($districts as $district){
				?>
				  <option value="<?php echo $district->id;?>"><?php echo utf8_encode($district->district_name);?></option>
				<?php
			  }
			  ?>
			
		  </select>
		  <input type="button" id="btnBuscarProvincia" value="Buscar">
		  </fieldset>
			<fieldset>
		  Buscar por Tema: <select id="buscarPorTema">
			<option value="default">Todos</option>
			<?php
			  foreach($themes as $theme){
				?>
				  <option value="<?php echo $theme->id;?>"><?php echo $theme->theme_name;?></option>
				<?php
			  }
			  ?>
		  </select>
		  <input type="button" id="btnBuscarTema" value="Buscar">
		  </fieldset>
		  <!--input type="button" id="btnLimpiar" value="Limpiar"-->
		</div>
		<div class="cl"></div>
    </div>
	
	
    <div id="map_canvas"></div>
 <div id="grilla">
	<table border="1">
     <thead class="color">
     	<th>Entidad</th>
     	<th>Nombre</th>
     	<th>Apellido</th>
     	<th>Email</th>
     </thead>
      <tbody id="datosGrilla">

      </tbody>
	</table>
  </div> 

    <div id="datosAccion">
		 <div>
		 <h2></h2>
		 <h5></h5>
		 <ul id="gallery">
		 </ul>
				<a id="prev3" class="prev" href="#">&lt;&lt;</a>
				<a id="next3" class="next" href="#">&gt;&gt;</a>
		 <p></p>
		 <div class="right">
		<a href="https://twitter.com/share" class="twitter-share-button"></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		 </div>
		 <div class="right">
		 <div class="fb-like" data-href="http://redcame.org.ar/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		 </div>

		</div>
	</div>
   
    <script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="js/jquery.colorbox-min.js"></script>
    <script src="js/maparse.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#grilla').hide();
        app.initialize();
        app.loadMarkers();
        $('#btnBuscarProvincia').on('click',function(){
          if($('#buscarPorProvincia').val() != 'default'){

            app.loadMarkersByDistrict($('#buscarPorProvincia').val());
          }
          else {
            app.loadMarkers();
          }
        })
        $('#btnBuscarTema').on('click',function(){
          if($('#buscarPorTema').val() != "default"){
          app.loadMarkersByTheme($('#buscarPorTema').val());
          }
          else {
            app.loadMarkers();
          }
        });
        $('#btnLimpiar').on('click',function(){
          app.loadMarkers();
        });
    });
    </script>
  </body>
</html>