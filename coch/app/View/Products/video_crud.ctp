<h1><?php
if(!empty($this->data)) echo h(__('Editar video de producto'));
else echo h(__('Nuevo video de producto'));
echo ': ' . h($product['Product']['name']);
?></h1>

Para el campo Dirección de YouTube, debe entrar a YouTube y dirigirse al video que quiere insertar. Luego,
en la página seleccione la opción Compartir y haga click en el campo de texto que aparece. Entonces, copie el texto
y péguelo en el campo 'Dirección de YouTube' en esta misma página.<br><br>
<?php

echo $this->Form->create('ProductVideo');
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('product_id', array('type' => 'hidden', 'value' => $product['Product']['id']));
echo $this->Form->input('youtube_url', array('label' => __('Dirección de YouTube')));
echo $this->Form->input('description', array('label' => __('Descripción'), 'style' => 'width: 300px; height: 200px'));
echo $this->Form->end(__('Guardar cambios'));
?>
