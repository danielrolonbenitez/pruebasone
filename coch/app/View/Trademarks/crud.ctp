<h1><?php
if(!empty($this->data)) echo h(__('Editar marca'));
else echo h(__('Nueva marca'));
?></h1>

<?php

echo $this->Form->create('Trademark', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('name', array('label' => __('Nombre')));
echo $this->Form->input('picture', array('name' => 'picture', 'label' => __('Imagen'), 'type' => 'file'));
echo $this->Form->end(__('Guardar cambios'));
?>