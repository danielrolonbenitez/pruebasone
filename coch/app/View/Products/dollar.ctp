<h1>Cotización del dólar</h1>
<?php

echo $this->Form->create('Currency');
echo $this->Form->input('id', array('value' => 2));
echo $this->Form->input('value', array('label' => 'Valor en pesos'));

echo $this->Form->end(__('Guardar cambios'));

?>
