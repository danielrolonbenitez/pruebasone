<h1><?php echo __('Inicio de sesión'); ?></h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('User.username', array('label' => __('Usuario')));
echo $this->Form->input('User.password', array('label' => __('Contraseña')));
echo $this->Form->end(__('Iniciar sesión'));
?>
