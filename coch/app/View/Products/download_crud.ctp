<h1><?php
if(!empty($this->data)) echo h(__('Editar descarga de producto'));
else echo h(__('Nueva descarga de producto'));
echo ': ' . h($product['Product']['name']);
?></h1>

<?php

echo $this->Form->create('ProductDownload', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('product_id', array('type' => 'hidden', 'value' => $product['Product']['id']));
echo $this->Form->input('title', array('label' => __('Título')));
echo $this->Form->input('description', array('label' => __('Descripción'), 'type' => 'textarea', 'style' => 'width: 300px; height: 200px'));
?>

<div class="input file">
	<label for="ProductPicture">Archivo</label>
	<span class="holo"><input type="file" name="file" id="ProductPicture"></span>
</div>
<script type="text/javascript">
$("#delete-picture").click(function() {
	$("#ProductPicture").prop("disabled", $("#delete-picture").is(":checked"));
});
</script>
<?php
echo $this->Form->end(__('Guardar cambios'));
?>
