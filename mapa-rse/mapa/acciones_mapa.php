<?php
include_once('/clases/MySQL.php');
include_once('Upload.php');
$MySQL = MySQL::getInstance();

 function truncate($texto,$caracteres=100){
 	if(strlen($texto)>$caracteres)  {
 		$truncated = strpos($texto,0,$caracteres);
 		$truncated .= '...';
 		return $truncated;
 	}
 	else  {
 		return $texto;
 	}
 }

function vnsbo_plugin_options() {
	$MySQL = MySQL::getInstance();
	
	if(!isset($_SESSION['user']) || isset($_GET['login'])) return vnsbo_plugin_login();
	if(isset($_GET['nuevo'])) return vnsbo_plugin_options_abm();
	if(isset($_GET['id'])) return vnsbo_plugin_options_abm($_GET['id']);
	if(isset($_GET['provincia'])) return vnsbo_plugin_options_provinces($_GET['provincia']);
	if(isset($_GET['ciudad'])) return vnsbo_plugin_options_cities($_GET['ciudad']);
	if(isset($_GET['delete'])) return vnsbo_plugin_options_delete($_GET['delete']);
	if(isset($_GET['delete_image'])){
		$id = $_GET['delete_image'];
		$location_id = $_GET['location_id']; 
		return vnsbo_plugin_options_delete_image($id,$location_id);
	}

	$sql = "SELECT l.*, t.theme_name as theme, d.district_name as district FROM locations l INNER JOIN themes t ON l.theme_id = t.ID INNER JOIN districts d ON l.district_id = d.ID ORDER BY district_id, name";
	//echo $sql;
	$MySQL->setQuery($sql);
	$locations = $MySQL->loadObjectList();
	
	
	echo '<div class="wrap">';
	echo '<h2>Administrar <a class="add-new-h2" href="' . htmlspecialchars('?nuevo=nuevo') . '">Añadir nueva</a></h2>';
	
	echo <<<FIN
<table class="wp-list-table widefat fixed">
	<thead>
		<tr>
			<th class="manage-column column-cb" align="left">Cámara</th>
			<th class="manage-column column-cb" align="left">Provincia</th>
			<th class="manage-column column-cb" align="left">Tema</th>
			<th class="manage-column column-cb" align="left">Res&uacute;men</th>
			<th class="manage-column column-cb" width="100" align="center">Acciones</th>
		</tr>
	</thead>
	<tbody>
FIN;
	foreach($locations as $location) {
		//print_r($location);
		echo '<tr>';
		echo '<td align="left" class="post-title page-title column-title">';
		echo '<strong>';
		echo '<a title="Editar sucursal" href="?id=' . $location->ID . '" class="row-title">' . ($location->camera) . '</a>';
		echo '</strong>';
		echo '</td>';
		echo '<td align="left">' . utf8_encode($location->district) . '</td>';
		echo '<td align="left">' . utf8_encode($location->theme) . '</td>';
		echo '<td align="left">'.truncate(utf8_encode($location->text));
		echo '<td align="center">' ;
		echo '<div class="row-actions">';
		echo '<span class="edit"><a title="Editar" href="?id=' . $location->ID . '">Editar</a> | ';
		echo '<span class="trash"><a onclick="return confirm(\'¿Está seguro de que desea eliminar este elemento?\')" href="?delete=' . $location->ID . '" title="Eliminar" class="submitdelete">Eliminar</a>';
		echo '</div>';
		echo '</td>';
		echo '</tr>';
	}
		echo <<<FIN
	</tbody>
</table>
FIN;
	
	echo '</div>';
}

function vnsbo_plugin_options_abm($id = NULL) {
	$MySQL = MySQL::getInstance();
	
	if(!empty($_POST)) {
		
		$latlng = explode("/", $_POST['pos']);
		
		if(empty($_POST['id'])) $sql = "INSERT INTO locations SET ";
		else $sql = "UPDATE locations SET ";
		
		if(!empty($_POST['ciudad-input'])) {
			$sql_city = "INSERT INTO cities SET " .
				"city_name = '" . addslashes($_POST['ciudad-input']) . "', " .
				"district_id = " . sprintf('%d', $_POST['provincia-select']);
				
			$MySQL->setQuery($sql_city);
			$MySQL->execute();			
				
			$_POST['ciudad-select'] = $MySQL->getId();			
		}
		
		
		
		$sql .= "district_id = " . sprintf('%d', $_POST['provincia-select']) . ", " .
			"city_id = '" . addslashes($_POST['ciudad-select']) . "', " .
			"theme_id = '" . addslashes($_POST['tema-select']) . "', " .
			"address = '" . addslashes($_POST['direccion']) . "', " .
			"camera = '" . addslashes($_POST['camara']) . "', " .
			"text = '" . addslashes($_POST['texto']) . "', " .
			"latitude = " . sprintf("%F", $latlng[0]) . ", " .
			"longitude = " . sprintf("%F", $latlng[1]);
			
		if(!empty($_POST['id'])) $sql .= " WHERE ID = " . sprintf('%d', $_POST['id']);		
		
		$MySQL->setQuery($sql);
		$MySQL->execute();
		
		if(empty($_POST['id'])) $_POST['id'] = $MySQL->getId();
		
		if(count($_FILES['imagenes']['name'])>0){
			foreach($_FILES['imagenes']['name'] as $i => $foto) {
				if (!empty($foto)) {
					$file = array();
					$file['name'] = $_FILES['imagenes']['name'][$i];
					$file['type'] = $_FILES['imagenes']['type'][$i];
					$file['tmp_name'] = $_FILES['imagenes']['tmp_name'][$i];
					$file['error'] = $_FILES['imagenes']['error'][$i];
					$file['size'] = $_FILES['imagenes']['size'][$i];

					$handle = new upload($file);
					if ($handle->uploaded) {
						$handle->process('../imagenes/');
						if ($handle->processed) {
							$image = "$handle->file_dst_name_body.$handle->file_dst_name_ext";
							$thumb = "$handle->file_dst_name_body";
						} else {
							echo 'error : ' . $handle->error;
						}
					}

					$handle = new upload($file);
					if ($handle->uploaded) {
						$handle->file_new_name_body = $thumb;
						$handle->image_resize = true;
						$handle->image_x = 250;
						$handle->image_y = 180;
						$handle->image_ratio_crop = true;

						$handle->process('../imagenes/thumbs');
						if ($handle->processed) {
							$handle->clean();
						} else {
							echo 'error : ' . $handle->error;
						}
					}

					$sql_city = "INSERT INTO location_images SET " .
						"image = '" . $image . "', " .
						"location_id = " . sprintf('%d', $_POST['id']);
					$MySQL->setQuery($sql_city);
					$MySQL->execute();
				}
			}
		}
		
		echo '<script>';
		echo 'location.replace("index.php");';
		echo '</script>';
		
		
		
		die();
	}
	
	
	if($id) echo '<h2>Editar <a class="add-new-h2" href="' . htmlspecialchars('index.php') . '">Volver</a></h2>';
	else echo '<h2>Nueva <a class="add-new-h2" href="' . htmlspecialchars('index.php') . '">Volver</a></h2>';
	
	if($id) {
		$sql = "SELECT * FROM locations WHERE id = " . sprintf('%d', $id);
		$MySQL->setQuery($sql);
		$item = $MySQL->loadObject();
		
		$item->loc = $item->latitude . '/' . $item->longitude;
		
		$sql = "SELECT * FROM location_images WHERE location_id = " . sprintf('%d', $id);
		$MySQL->setQuery($sql);
		$sql_images = $MySQL->loadObjectList();
		
		$imagenes = '<div id="galeria">';
		foreach($sql_images as $image) {
			$imagenes .= '<div>';
			$imagenes .= '<img src="../imagenes/thumbs/' . $image->image . '" width="100" />';
			$imagenes .= '<a href="?delete_image=' . $image->ID . '&location_id='. $id .'">Eliminar</a>';
			$imagenes .= '</div>';
		}
		$imagenes .= '</div>';
	
	}
	else {
		$item = new stdClass();
		$item->ID = "";
		$item->district_id = 1;
		$item->city_id = 1;
		$item->theme_id = 1;
		$item->address = "";
		$item->camera = "";
		$item->text = "";
		$item->loc = "";
	}
	foreach($item as $i => $v) {
		$item->{$i} = htmlspecialchars($v);
	}
		
	$sql = "SELECT * FROM themes ORDER BY theme_name ASC" ;
	$MySQL->setQuery($sql);
	$sql_themes = $MySQL->loadObjectList();
	
	
	$themes = "";
	foreach($sql_themes as $theme) {
		$themes .= '<option value="' . sprintf('%d', $theme->ID) . '"';
		if($theme->ID == $item->theme_id) $themes .= ' selected';
		$themes .= '>';
		$themes .= htmlspecialchars($theme->theme_name);
		$themes .= '</option>';
	}
		
	$sql = "SELECT * FROM districts ORDER BY district_name ASC" ;
	$MySQL->setQuery($sql);
	$sql_district = $MySQL->loadObjectList();
	
	
	$districts = "";
	foreach($sql_district as $district) {
		$districts .= '<option value="' . sprintf('%d', $district->ID) . '"';
		if($district->ID == $item->district_id) $districts .= ' selected';
		$districts .= '>';
		$districts .= utf8_encode($district->district_name);
		$districts .= '</option>';
	}
	
	$ajax_prov = 'ajax.php?cities=';
	if(!isset($imagenes)){
		$imagenes = '';
	}
	
	echo <<<END
	<form method="post" action="index.php?id={$item->ID}" enctype="multipart/form-data">
		<input type="hidden" name="id" value="{$item->ID}">
		<table class="form-table">
			<tr id="sel-tema">
				<td style="width: 80px"><label for="tema-select">Tema:</label></td>
				<td>
					<select id="tema-select" name="tema-select">
						$themes
					</select>
				</td>
			</tr>
			<tr id="sel-provincia">
				<td style="width:80px"><label for="provincia-select">Provincia:</label></td>
				<td>
					<select id="provincia-select" name="provincia-select">
						$districts
					</select>
				</td>
			</tr>
			
			<tr id="sel-ciudad">
				<td><label for="ciudad-select">Ciudad:</label></td>
				<td>
					<select data-origval="{$item->city_id}" id="ciudad-select" name="ciudad-select">
						<option value="-1">Agregar ciudad...</option>
					</select>
				</td>
			</tr>
			<tr id="input-ciudad" style="display: none">
				<td><label for="ciudad-input">Ciudad:</label></td>
				<td>
					<input type="text" name="ciudad-input" disabled>
				</td>
			</tr>
			<tr>
				<td><label for="nombre">Dirección:</label></td>
				<td><input type="text" value="{$item->address}" name="direccion">
			</tr>
			<tr>
				<td colspan="2" valign="top" align="center">
					Ubicar la posición del mapa en Google Maps.
					<input type="text" style="display: block; width: 400px" id="dir-map" placeholder="Ubicación...">
					<div id="gmap" style="width: 400px; height: 400px"></div>
				</td>
			</tr>
			<tr>
				<td><label for="camara">Cámara:</label></td>
				<td><input type="text" value="{$item->camera}" name="camara"></td>
			</tr>
			<tr>
				<td><label for="texto">Texto:</label></td>
				<td><textarea name="texto" style="height: 200px">{$item->text}</textarea></td>
			</tr>
			<tr>
				<td><label for="imagenes">Subir Imágenes:</label></td>
				<td><input type="file" name="imagenes[]" multiple></td>
			</tr>
			<tr>
				<td colspan="2" valign="top" align="center">
					$imagenes
				</td>
			</tr>
		</table>
		<div align="center" style="margin-top: 30px;"><button type="submit">Guardar cambios</button></div>
		<input type="hidden" id="pos" name="pos" value="{$item->loc}">
	</form>
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script type="text/javascript">
		var jq = jQuery;
		
		jq("#input-provincia input").blur(function() {
			if(!jq(this).val()) {
				jq("#sel-provincia").show();
				jq("#sel-provincia select").prop("disabled", false).focus();
				jq("#sel-provincia select option:first").prop("selected", true);
				jq("#sel-provincia select").trigger("click");
				jq("#input-provincia").hide();
				jq("#input-provincia input").prop("disabled", true).val("");
			}
			else {
				jq("#input-ciudad").hide();
				jq("#input-ciudad input").prop("disabled", true).val("");
				
				jq("#sel-ciudad").show();
				jq("#sel-ciudad select").empty();
				var option = jq("<option></option>");
				option.attr("value", "-1");
				option.text("Agregar ciudad...");
				jq("#sel-ciudad select").append(option);
				jq("#sel-ciudad select").prop("disabled", false);
			}
		});
		
		jq("#sel-provincia select").click(function() {
				if(jq("#sel-provincia select").val() == jq("#sel-provincia select").data("old-value")) return;
				
				jq("#sel-provincia select").data("old-value", jq("#sel-provincia select").val());
				
				jq("#input-ciudad input").val("").prop("disabled", true);
				jq("#input-ciudad").hide();
				
				jq("#sel-ciudad").show();
				jq("#sel-ciudad select").prop("disabled", true).html("<option>Espere...</option>");
				
				jq.ajax({
					"url": "$ajax_prov" + jq("#sel-provincia select").val(),
					"type": "GET",
					"dataType": "json",
					"success": function(data) {
						console.log(data);
						jq("#sel-ciudad select").empty();
						
						for(i in data) {
							var option = jq("<option></option>");
							option.attr("value", i);
							option.text(data[i]);
							jq("#sel-ciudad select").append(option);
							
							if(jq("#sel-ciudad select").data("origval")) {
								if(jq("#sel-ciudad select").data("origval") == i) {
									jq("#sel-ciudad select").data("origval", null);
									option.attr("selected", "selected");
								}
							}
						}
						
						var option = jq("<option></option>");
						option.attr("value", "-1");
						option.text("Agregar ciudad...");
						
						jq("#sel-ciudad select").append(option);
						jq("#sel-ciudad select").prop("disabled", false);
					}
				});
		});
		
		jq('#ciudad-select').click(function(e) {
			var me = jq(this);
			if(me.val() == -1) {
				jq("#sel-ciudad").hide();
				jq("#sel-ciudad select").prop("disabled", true);
				jq("#input-ciudad").show();
				jq("#input-ciudad input").prop("disabled", false).focus();
			}
		});
		jq("#input-ciudad input").blur(function() {
			if(!jq(this).val()) {
				jq("#sel-ciudad").show();
				jq("#sel-ciudad select").prop("disabled", false).focus();
				jq("#sel-ciudad select option:first").prop("selected", true);
				jq("#input-ciudad").hide();
				jq("#input-ciudad input").prop("disabled", true).val("");
			}
		});
		
		jq('#provincia-select').trigger("click");
		
var map;
var marker = null;
function initialize() {
	var mapOptions = {
		zoom: 10,
		center: new google.maps.LatLng(-34.6037232, -58.38159310000003)
	};
	map = new google.maps.Map(
		document.getElementById('gmap'),
		mapOptions
	);
	marker = new google.maps.Marker();
	
	if(jq("#pos").val()) {
		var latlong = jq("#pos").val().split("/");
		var pos = new google.maps.LatLng(latlong[0], latlong[1]);
		
		marker.setPosition(pos);
		marker.setMap(map);
		map.setCenter(pos);
		map.setZoom(14);
	}
	
	google.maps.event.addListener(map, 'click', function(e) {
		marker.setPosition(e.latLng);
		marker.setMap(map);
		jq("#pos").val(e.latLng.lat() + "/" + e.latLng.lng());
	});
	
	jq("#dir-map").keypress(function(e) {
		if(e.keyCode == 10 || e.keyCode == 13) {
			e.preventDefault();
			
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				"address": jq("#dir-map").val(),
			}, function(results, status) {
					if(status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						map.setZoom(16);
						jq("#pos").val(results[0].geometry.location.k+ "/" +results[0].geometry.location.D);
						var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location
						});
					}
			});
		}
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
	</script>
END;
}

function vnsbo_plugin_options_delete($id) {
	$MySQL = MySQL::getInstance();

	$sql = 'SELECT * FROM location_images WHERE location_id = ' . $id;
	$MySQL->setQuery($sql);
	$imagenes = $MySQL->loadObjectList();
	foreach($imagenes as $imagen) {
		@unlink('../imagenes/'. $imagen->image);
		@unlink('../imagenes/thumbs/'. $imagen->image);
	}

	$sql = 'DELETE FROM locations WHERE ID = ' . $id;
	$MySQL->setQuery($sql);
	$MySQL->execute();
	
	echo '<script>';
	echo 'location.replace("index.php");';
	echo '</script>';
	
	die();
}

function vnsbo_plugin_options_delete_image($id,$location_id) {
	$MySQL = MySQL::getInstance();

	$sql = 'SELECT * FROM location_images WHERE ID = ' . $id;
	$MySQL->setQuery($sql);
	$imagen = $MySQL->loadObject();
	@unlink('../imagenes/'. $imagen->image);
	@unlink('../imagenes/thumbs/'. $imagen->image);

	$sql = 'DELETE FROM location_images WHERE ID = ' . $id;
	$MySQL->setQuery($sql);
	$MySQL->execute();
	
	echo '<script>';
	echo 'location.replace("index.php?id='.$location_id.'");';
	echo '</script>';
	
	die();
}

function vnsbo_plugin_login() {
	if(!empty($_POST)) {
	
		$MySQL = MySQL::getInstance();
		$user = $_POST['user'];
		$pass = md5($_POST['pass']);
		$sql = "SELECT * FROM user WHERE user = '{$user}' AND password = '{$pass}'";
		$MySQL->setQuery($sql);
		if($MySQL->getNumRows()>0){
			$usuario = $MySQL->loadObject();
			$_SESSION['user'] = $usuario->user;
		}
	
		echo '<script>';
		echo 'location.replace("index.php");';
		echo '</script>';
		die;
	}
	
	echo <<<END
	<form method="post" action="index.php?login=login">
		<table class="form-table">
			<tr>
				<td style="width: 80px"><label for="tema-user">Usuario:</label></td>
				<td><input type="text" name="user"></td>
			</tr>
			<tr>
				<td style="width: 80px"><label for="tema-user">Clave:</label></td>
				<td><input type="password" name="pass"></td>
			</tr>
		</table>
		<div align="center" style="margin-top: 30px;"><button type="submit">Acceder</button></div>
END;
}


?>