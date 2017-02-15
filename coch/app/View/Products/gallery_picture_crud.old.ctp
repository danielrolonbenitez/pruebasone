<h1>Elminar imagen</h1>
<?php
echo $this->Form->create('ProductPicture');
echo $this->Form->input('ProductPicture.id');
?>
¿Está seguro de que desea eliminar esta imagen?
<div class="submit">
	<button type="submit"><?php echo h(__('Cancelar')); ?></button>
	<button type="button" class="red-button" id="delete-picture"><?php echo h(__('Eliminar imagen')); ?></button>
</div>

<?php echo $this->Form->end(); ?>
<script type="text/javascript">
$("#delete-picture").click(function(e) {
	parent.deletePicture(<?php printf('%d', $this->request->data['ProductPicture']['id']); ?>);
	parent.$.fancybox.close();
});
</script>