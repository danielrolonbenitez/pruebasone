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
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="assets/css/plugins/jquery-ui/jquery-ui.min.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="assets/css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="assets/css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="assets/css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="assets/css/plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="assets/css/plugins/chosen/chosen.css">
	<!-- multi select -->
	<link rel="stylesheet" href="assets/css/plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="assets/css/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="assets/css/plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="assets/css/plugins/datepicker/datepicker.css">
	<!-- Daterangepicker -->
	<link rel="stylesheet" href="assets/css/plugins/daterangepicker/daterangepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="assets/css/plugins/plupload/jquery.plupload.queue.css">
	<!-- select2 -->
	<link rel="stylesheet" href="assets/css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="assets/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="assets/css/themes.css">


	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/scripts.js" type="text/javascript"></script>

	<!-- Nice Scroll -->
	<script src="assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="assets/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="assets/js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="assets/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Masked inputs -->
	<script src="assets/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="assets/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="assets/js/plugins/daterangepicker/moment.min.js"></script>
	<script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Timepicker -->
	<script src="assets/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="assets/js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="assets/js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- MultiSelect -->
	<script src="assets/js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="assets/js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="assets/js/plugins/plupload/plupload.full.min.js"></script>
	<script src="assets/js/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
	<!-- Custom file upload -->
	<script src="assets/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="assets/js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="assets/js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="assets/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="assets/js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="assets/js/plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Mockjax -->
	<script src="assets/js/plugins/mockjax/jquery.mockjax.js"></script>


	<!-- Theme framework -->
	<script src="assets/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="assets/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="assets/js/demonstration.min.js"></script>

	<!--[if lte IE 9]>
		<script src="assets/js/plugins/placeholder/jquery.placeholder.min.js"></script>
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
			
			<ul class='main-nav'>
				<form action="/mapa/came-form/logout" method="POST">
					<button class="btn btn-blue" type="submit">Cerrar Sesioacute;n</button>
					<input type="hidden" name="_METHOD" value="DELETE"/>
				</form>
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
					<div class="pull-left"><?php // $app = MySlim::getInstance(); print_r($app->session->get('current_user'));?>
						<h1>Carga de Actividades </h1>
					</div>
					
				</div>
			<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Cámara</th>
											<th class="hidden-350">Texto corto</th>
											<th class="hidden-1024">Acciones</th>
											
										</tr>
									</thead>
									<tbody>
									
										<?php foreach($data as $actividad):?>
										<tr data-id="<?php echo $actividad['id_actividad'] ?>" data-identidad="<?php echo $actividad['id_identidad'] ?>">
											<td><?php echo $actividad['fecha'] ?></td>
											<td>
												<?php echo $actividad['identidad'];?>
											</td>
											<td class="hidden-350"><?php echo $actividad['texto_corto'];?></td>
											<td class="hidden-1024"><a href="#" class="btn btn-lightgrey" data-toggle="modal" data-target="#actividad-<?php echo $actividad['id_actividad'] ?>" style="margin-right: 3px;">Ver</a><a href="#" style="margin-right: 3px;"class="btn btn-green aprobar">Aprobar</a><a href="#" class="btn btn-red rechazar">Rechazar</a></td>
											<div id="actividad-<?php echo $actividad['id_actividad'] ?>" class="modal fade" role="dialog">
											  <div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title text-center">Actividad de <?php echo $actividad['identidad']; ?></h4>
												  </div>
												  <div class="modal-body">
													<div class="container-fluid">
													<div class="row">
														<div class="col-sm-12">
															<label for="textfield" class="control-label  col-sm-3">Categoría:</label>
															<div class="col-sm-9">
																Sensibilización
															</div>
														</div>
														<div class="col-sm-12">
															<label for="nombre_actividad" class="control-label  col-sm-3">Nombre de la actividad</label>
															<div class="col-sm-9">
															<?php echo $actividad['nombre_actividad'];?>
															</div>
														</div>
														<div class="col-sm-12">
															<label for="fecha" class="control-label  col-sm-3">Fecha</label>
															<div class="col-sm-9">
																<?php echo $actividad['fecha']; ?>
															</div>
														</div>
														<div class="col-sm-12">
															<label for="timepicker" class="control-label  col-sm-3">Horario</label>
															<div class="col-sm-9">
																<div class="bootstrap-timepicker">
																	<?php echo $actividad['hora'];?>
																</div>
															</div>
														</div>
														<div class="col-sm-12">
															<label for="lugar" class="control-label  col-sm-3">Lugar</label>
															<div class="col-sm-9">
																<?php echo $actividad['lugar'];?>
															</div>
														</div>
														
														<div class="col-sm-12">
															<label for="texto_corto" class="control-label  col-sm-3">Texto corto</label>
															<div class="col-sm-9">
																<?php echo $actividad['texto_corto'];?>
															</div>
														</div>

														<div class="col-sm-12">
															<label for="textarea" class="control-label  col-sm-3">Texto largo</label>
															<div class="col-sm-9">
															<?php echo $actividad['texto_largo'];?>
															</div>
														</div>
														<div class="col-sm-12">
															<label for="textfield" class="control-label  col-sm-3">Sitio web (opcional)</label>
															<div class="col-sm-9">
																<?php echo $actividad['sitio_web'];?>
															</div>
														</div>
														
														<?php if(!empty($actividad['imagenes_location'])): 
															$actividad['imagenes_location']=explode(',',$actividad['imagenes_location']); 
														?>
														<div class="col-sm-12">
															<label for="textfield" class="control-label  col-sm-3">Imagenes</label>
															<div class="col-sm-10">
																<?php foreach($actividad['imagenes_location'] as $imgUrl): ?>
																<div class="col-sm-10"><img class="col-sm-11" src="<?php echo $imgUrl; ?>" /></div>
																<?php endforeach; ?>
															</div>
														</div>
														<?php endif;?>
														
														<div class="col-sm-12">
															<label for="textarea" class="control-label  col-sm-3">Notas</label>
															<div class="col-sm-9">
																<?php echo $actividad['notas'];?>
															</div>
														</div>
														<div class="col-sm-12 text-center">
															<h3>Información adicional (sólo visualización interna):</h3>
														</div>
														<br><br>
														<div class="col-sm-12">
															<label for="textfield" class="control-label  col-sm-3">Cantidad de asistentes</label>
															<div class="col-sm-9">
																<?php echo $actividad['cantidad_asistentes'];?>
															</div>
														</div>

														<div class="col-sm-12">
															<label for="textarea" class="control-label  col-sm-3">Información Reservada</label>
															<div class="col-sm-9">
																<?php echo $actividad['informacion_reservada'];?>
															</div>
														</div>
												  </div>
												  </div>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												  </div>
												</div>
											  </div>
											</div>
										</tr>
											<?php endforeach;?>
										<!----  EMPTY IDENTIDAD ---->
										<div  class="modal fade empty-modal" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title text-center">Asignar Camara/Federacion a Actividad</h4>
												  </div>
												  <div class="modal-body">
													<div class="container-fluid">
													<div class="row">
														<div class="col-sm-12 contenido">
															<form id="theForm" action="<?php echo $baseUrl;?>/mapa/came-form/form/actualizar">
																<div class="form-group">
																	<label for="textfield" class="control-label col-sm-4">C&aacute;mara/Federaci&oacute;n</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="autocomplete" name="tosplit" >
																		<input type="hidden" id="id_actividad" name="id_actividad">
																	</div>
																</div>
																<div class="form-group pull-right">
																	<button type="submit" class="btn-default btn" id="asignar">Asignar</button>
																</div>
															</form>
														</div>
													</div>
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
												  </div>
												</div>
											</div>
										</div>
										<!---- EMPTY IDENTIDAD ---->
									
									</tbody>
								</table>
								<div class="table-pagination">
									<a href="#" class="disabled">Primera</a>
									<a href="#" class="disabled">Anterior</a>
									<span>
										<a href="#" class="active">1</a>
										<a href="#">2</a>
										<a href="#">3</a>
									</span>
									<a href="#">Siguiente</a>
									<a href="#">Última</a>
								</div>
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
	<style>
	    .ui-autocomplete { height: 400px; overflow-y: scroll; overflow-x: hidden; z-index:9999; max-width:24.8%}
		.empty-modal .modal-body{
			max-height:400px;
		}
		.empty-modal button{
			margin-right:15px;
		}
	</style>
</body>

</html>
