<h1><?php
if(!empty($this->data)) echo h(__('Editar cliente'));
else echo h(__('Nuevo cliente'));
?></h1>

<?php

echo $this->Form->create('Client', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('name', array('label' => __('Nombre')));
echo $this->Form->input('surname', array('label' => __('Apellido')));
echo $this->Form->input('cuit', array('label' => __('CUIT')));
echo $this->Form->input('iva', array('label' => __('IVA')));
echo $this->Form->input('user', array('label' => __('Usuario')));
echo $this->Form->input('password', array('password' => __('Contraseña')));
echo $this->Form->input('enabled', array('password' => __('Habilitado')));
echo $this->Form->end(__('Guardar cambios'));
?>