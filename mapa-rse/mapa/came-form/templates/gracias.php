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
			<h1>Su informaci&oacute;n ha sido recibida</h1>
			<p> Si desea cargar otra actividad haga click <a href='http://redcame.org.ar/mapa/came-form/form'> aqu&iacute;</a>
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
