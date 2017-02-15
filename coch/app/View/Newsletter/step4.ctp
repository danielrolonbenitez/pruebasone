<?php echo $newsletter; ?>
<hr>

<div style="text-align: center">
	<iframe id="target" name="target" style="border: none; top: 0px; left: 0px; position: absolute; width: 1px; height: 1px; border: none"></iframe>
	<form target="target" action="<?php echo Router::url('/newsletter/step5', true); ?>" method="post">
		<textarea name="newsletter" style="width: 400px; height: 200px" id="newsletter"><?php echo h($newsletter); ?></textarea>
		<p>Enviar prueba a:</p>
		<input type="email" value="" name="email">
		<div><button type="submit">Enviar</button></div>
	</form>
	<p><a href="<?php echo h(Router::url('/panel', true)); ?>">Volver al panel de control</a></p>
</div>