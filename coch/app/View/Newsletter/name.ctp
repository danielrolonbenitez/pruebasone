<h1><?php echo h(__('Armar newsletters')); ?></h1>
<h2>Nombre del newsletter</h2>
<form method="GET" id="" action="<?php echo h(Router::url('/newsletter/step3', true)); ?>">
	<input type="hidden" name="ids" value="<?php echo h($_GET['ids']); ?>">
	<input type="hidden" name="ofr" value="<?php echo h($_GET['ofr']); ?>">
	<input type="hidden" name="art" value="<?php echo h($_GET['art']); ?>">
	<div class="input text"><label for="name">Nombre</label>
		<span class="holo">
			<input type="text" id="name" placeholder="Nombre" maxlength="50" name="name">
		</span>
	</div>
	<div class="submit">
		<input type="submit" value="Guardar cambios">
	</div>
</form>