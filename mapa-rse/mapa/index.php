<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Responsabilidad Social Empresaria :: CAME</title>
<script src="js/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="css/styles.css" />
</head>

<body>

<div id="header">
	<div id="logo"></div>
	<h1>Mapa PYME de Responsabilidad Social Empresaria</h1>
</div>

<div id="content">
<?php
include('acciones_mapa.php');
vnsbo_plugin_options();
?>
</div>
<script src="js/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('texto');
</script>
</body>
</html>
