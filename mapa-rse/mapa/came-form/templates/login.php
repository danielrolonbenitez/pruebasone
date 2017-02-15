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
	<!-- icheck -->
	<link rel="stylesheet" href="assets/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="assets/css/themes.css">


	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="assets/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="assets/js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="assets/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/eakroko.js"></script>

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

<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="/">
				<a href="#" id="" style="BACKGROUND: white;padding: 20px;"><img src="http://came.sandiamanagement.com/images/came_logo.svg" alt=""></a>
		</h1>
		<div class="login-body">
			<h2>INGRESAR</h2>
			<form action="login" method="post" class="form-validate" id="test">
				<div class="form-group">
					<div class="email controls">
						<input type="text" name='user' placeholder="Usuario" class='form-control' data-rule-required="true">
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<input type="password" name="password" placeholder="Contraseña" class='form-control' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<div class="remember">
						<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember">
						<label for="remember">Recordarme</label>
					</div>
					<input type="submit" value="Ingresar" class='btn btn-primary'>
				</div>
				
			</form>
			<div class="forget">
				<a href="#">
					<span>¿Olvidó la contraseña?</span>
				</a><?php //var_dump($data)?>
			</div>
			<?php 
				if($flash['login_error']):
			?>
				<div class="alert alert-danger text-center" role="alert"><?php echo $flash['login_error'];?></div>
			<?php 
				endif;
			?>
			<?php 
				if($flash['logout_success']):
			?>
				<div class="alert alert-success text-center" role="alert"><?php echo $flash['logout_success'];?></div>
			<?php 
				endif;
			?>
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
	</script>
</body>

</html>
