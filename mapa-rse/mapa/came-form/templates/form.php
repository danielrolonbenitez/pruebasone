<?php
if(isset($flash['message']) && $flash['message'] !=''){
	?>
	<script>
		alert('<?php echo $flash["message"];?>');
	</script>
	<?php
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>CAME</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/jquery-ui/jquery-ui.min.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/chosen/chosen.css">
	<!-- multi select -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/datepicker/datepicker.css">
	<!-- Daterangepicker -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/daterangepicker/daterangepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/plupload/jquery.plupload.queue.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo $baseUrl; ?>assets/js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $baseUrl; ?>assets/js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Masked inputs -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/daterangepicker/moment.min.js"></script>
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Timepicker -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- MultiSelect -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/plupload/plupload.full.min.js"></script>
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
	<!-- Custom file upload -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Mockjax -->
	<script src="<?php echo $baseUrl; ?>assets/js/plugins/mockjax/jquery.mockjax.js"></script>


	<!-- Theme framework -->
	<script src="<?php echo $baseUrl; ?>assets/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo $baseUrl; ?>assets/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo $baseUrl; ?>assets/js/demonstration.min.js"></script>

	<!--[if lte IE 9]>
		<script src="<?php echo $baseUrl; ?>assets/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="http://came.sandiamanagement.com/images/favicons/apple-touch-icon-57x57.png" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body data-layout="fixed">
	<div id="navigation" style="  background: white!important;
  text-align: center;
  padding-bottom: 15px;
  padding-top: 15px;">
		<div class="container-fluid">
			<a href="#" id=""><img src="http://redcame.org.ar/images/came_logo.svg" alt=""></a>
			<h1>Mapa nacional de capacitación</h1>
			<ul class='main-nav'>	
			</ul>
		
		</div>
	</div>
	<div id="navigation">
		<div class="container-fluid">
			
			
			<ul class='main-nav'>
				
				<div class="subnav-title">
					
				</div>
				
			
			</ul>
		
		</div>
	</div>
	<div class="container-fluid nav-hidden" id="content">

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Carga de Actividades</h1>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							
							<div class="box-content">
								<form action="<?php echo $actionUrl; ?>" method="POST" class='form-horizontal' enctype="multipart/form-data">
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">C&aacute;mara/Federación</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="autocomplete" name="identidad">
											<span>Por favor comience escribiendo el nombre de su entidad y seleccionelo de la lista desplegable (minimo escriba 3 caracteres)</span>
											
										</div>
									</div>
									
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Categoría:</label>
										<div class="col-sm-10">
											<select name="categoria" id="s2" class="select2-me select2-offscreen" style="width:250px;" required >
												<option value="01">Sensibilización</option>
												<option value="02" selected>Capacitación</option>
												<option value="03">Asistencia</option>
												<option value="04">Otras Actividades</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="nombre_actividad" class="control-label col-sm-2">Nombre de la actividad</label>
										<div class="col-sm-10">
											<input type="text" name="nombre_actividad" id="textfield" class="form-control" required>
										</div>

									</div>
									<div class="form-group">
										<label for="fecha" class="control-label col-sm-2">Fecha</label>
										<div class="col-sm-10">
											<input type="text" name="fecha" id="textfield" class="form-control mask_date">
											<span class="help-block">Formato: AAAA/MM/DD</span>
										</div>
									</div>
									<div class="form-group">
										<label for="timepicker" class="control-label col-sm-2">Horario</label>
										<div class="col-sm-10">
											<div class="bootstrap-timepicker">
												<input type="text" name="hora" id="timepicker" class="form-control timepick" >
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="lugar" class="control-label col-sm-2">Lugar</label>
										<div class="col-sm-10">
											<input type="text" name="lugar" id="textfield" class="form-control">
											
										</div>

									</div>
									<div class="form-group">
										<label for="texto_corto" class="control-label col-sm-2">Texto corto</label>
										<div class="col-sm-10">
											<textarea name="texto_corto" id="textarea" class="form-control" placeholder="Completar"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="textarea" class="control-label col-sm-2" style="height: 200px;">Texto largo</label>
										<div class="col-sm-10">
											<textarea name="texto_largo" id="textarea" class="form-control"  style="height: 200px;" placeholder="Completar"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Sitio web (opcional)</label>
										<div class="col-sm-10">
											<input type="text" name="sitio_web" id="textfield" class="form-control">
											
										</div>

									</div>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Cargar hasta 5 fotos</label>
										<div class="col-sm-10">
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px; line-height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Seleccionar</span>
													<span class="fileinput-exists">Cambiar</span>
													<input class="btn" name="image[]" type="file" multiple="multiple" accept="image/jpg, image/jpeg"/>
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
												</div>
											</div>
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px; line-height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Seleccionar</span>
													<span class="fileinput-exists">Cambiar</span>
													<input class="btn" name="image[]" type="file" multiple="multiple" accept="image/jpg, image/jpeg"/>
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
												</div>
											</div>
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px; line-height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Seleccionar</span>
													<span class="fileinput-exists">Cambiar</span>
													<input class="btn" name="image[]" type="file" multiple="multiple" accept="image/jpg, image/jpeg"/>
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
												</div>
											</div>
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px; line-height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Seleccionar</span>
													<span class="fileinput-exists">Cambiar</span>
													<input class="btn" name="image[]" type="file" multiple="multiple" accept="image/jpg, image/jpeg"/>
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
												</div>
											</div>
											<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px; line-height: 150px;"></div>
												<div>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Seleccionar</span>
													<span class="fileinput-exists">Cambiar</span>
													<input class="btn" name="image[]" type="file" multiple="multiple" accept="image/jpg, image/jpeg"/>
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="textarea" class="control-label col-sm-2">Notas</label>
										<div class="col-sm-10">
											<textarea name="notas" id="textarea" class="form-control" placeholder="Completar"></textarea>
										</div>
									</div>
									<div class="box-title">
								<h3>
									Información adicional (sólo visualización interna):   </h3>
							</div>
							<br><br>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Cantidad de asistentes</label>
										<div class="col-sm-10">
											<input type="text" name="cantidad_asistentes" id="textfield" class="form-control">
											
										</div>

									</div>

									<div class="form-group">
										<label for="textarea" class="control-label col-sm-2">Información Reservada</label>
										<div class="col-sm-10">
											<textarea name="informacion_reservada" id="textarea" class="form-control" placeholder="Completar"></textarea>
										</div>
									</div>

									<div class="form-actions" style="  text-align: right;">
										
										<input type="submit" class="btn btn-primary" value='Enviar'>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-38620714-4']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
	function split( val ) {
      return val.split( /,\s*/ );
    }
	function extractLast( term ) {
      return split( term ).pop();
    }
	jQuery(document).ready(function(){
		$( "#autocomplete" ).autocomplete({
			source: function (request, respond) {
				$.post("<?php echo $baseUrl.'autocomplete/camara-federacion'; ?>",{term:request.term},function(data){
					respond(data);
				},'json');
			}
		});
	});
	</script>
</body>

</html>
