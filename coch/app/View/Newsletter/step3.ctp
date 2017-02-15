<h1>Armar newsletter</h1>

<form method="post" action="<?php echo Router::url('/newsletter/step4'); ?>">
	<textarea name="newsletter" style="width: 650px; height: 300px" id="newsletter-edit"><?php echo h($newsletter); ?></textarea>
	<div style="margin-top: 1em; text-align: center">
		<button type="submit">Vista previa</button>
	</div>
	
</form>

<script type="text/javascript" src="<?php echo Router::url('/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
tinymce.init({
	"plugins": "code",
	"selector": "textarea",
	"relative_urls": false,
	"remove_script_host": false
 });
</script>
