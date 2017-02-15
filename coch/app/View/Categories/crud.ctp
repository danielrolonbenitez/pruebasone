<h1><?php
if(!empty($this->data)) echo h(__('Editar categoría'));
else echo h(__('Nueva categoría'));
?></h1>

<?php

echo $this->Form->create(
	'Category',
	array(
		'enctype' => 'multipart/form-data',
		'action' => 'crud'
	)
);
if(!empty($this->data)) echo $this->Form->input('id');

if(!empty($category_id)) echo $this->Form->input('category_id', array('type' => 'hidden', 'value' => $category_id));

echo $this->Form->input('name', array('label' => __('Nombre del menú')));
echo $this->Form->input('title', array('label' => __('Título')));
echo $this->Form->end(__('Guardar cambios'));
?>