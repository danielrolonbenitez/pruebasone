<h1><?php
if(!empty($this->data)) echo h(__('Editar característica de producto'));
else echo h(__('Nueva característica de producto'));
echo ': ' . h($product['Product']['name']);
?></h1>

<?php

echo $this->Form->create('ProductFeature', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('product_id', array('type' => 'hidden', 'value' => $product['Product']['id']));
echo $this->Form->input('title', array('label' => __('Título')));
?>

<div class="input file">
	<label for="ProductPicture">Imagen (Res: 303x207)</label>
	<span class="holo"><input type="file" name="picture" placeholder="Imagen" id="ProductPicture"></span>
	<?php if(!empty($this->data['Product']['id'])) : ?>
		<br><label style="width: auto; margin-left: 100px">
			<input type="checkbox" name="delete-picture" value="1" id="delete-picture">
			Eliminar imagen actual
		</label>
	<?php endif; ?>
</div>
<script type="text/javascript">
$("#delete-picture").click(function() {
	$("#ProductPicture").prop("disabled", $("#delete-picture").is(":checked"));
});
</script>
<?php
echo $this->Form->input('description', array('label' => __('Descripción'), 'style' => 'width: 300px; height: 200px'));
echo $this->Form->end(__('Guardar cambios'));
?>
