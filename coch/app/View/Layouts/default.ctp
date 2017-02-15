<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo h(Router::url('/', true)); ?>">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>COCH</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
	<!--[if IE]>
		  <link rel="stylesheet" type="text/css" href="css/all-ie-only.css" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="css/droppy.css" />
	<!-- JS -->
	<script type="text/javascript" src="js/jquery.1.8.3.js"></script>
	<script type="text/javascript" src="js/html5.js"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<!-- WOWSlider --><link rel="stylesheet" type="text/css" href="css/wowslider.css"/>
	
	
		<?php echo $this->fetch('scriptTop'); ?>
	</head>
	<body>
		<?php echo $this->Element('header'); ?>
		<?php echo $this->fetch('content'); ?>
		<?php echo $this->Element('footer'); ?>
	</body>
</html>