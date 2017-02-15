<h1><?php echo h(__('Nueva galería')); ?></h1>

<?php
echo $this->Form->create('Gallery', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('name', array('label' => __('Nombre')));
echo $this->Form->end(__('Siguiente')); ?>