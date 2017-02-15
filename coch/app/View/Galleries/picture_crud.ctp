<h1>Datos de imagen</h1>
<?php
echo $this->Form->create('GalleryPicture');
echo $this->Form->input('GalleryPicture.id');
echo $this->Form->input('GalleryPicture.description', array('label' => __('Descripción')));
?>

<div class="submit">
	<button type="submit"><?php echo h(__('Guardar cambios')); ?></button>
	<button type="button" class="red-button" id="delete-picture"><?php echo h(__('Eliminar imagen')); ?></button>
</div>

<?php echo $this->Form->end(); ?>
<script type="text/javascript">
$("#delete-picture").click(function(e) {
	if(confirm("<?php echo addslashes(__('¿Está seguro de que desea eliminar esta imagen?')); ?>")) {
		parent.deletePicture(<?php printf('%d', $this->request->data['GalleryPicture']['id']); ?>);
		parent.$.fancybox.close();
	}
});
</script>