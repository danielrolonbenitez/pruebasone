<h1><?php echo h(__('Listado de marcas')); ?></h1>
<?php

$this->Html->css('jquery.treetable', 'stylesheet', array('block' => 'script'));
echo $this->Html->script('jquery.treetable');

/*
echo $this->Form->create('Category');
echo $this->Form->hidden('type', array('value' => 'search'));
echo $this->Form->input('title', array('label' => __('Texto a buscar')));
echo $this->Form->end(__('Buscar'));*/
?>

<?php
echo $this->Html->link(
	__('Nueva marca'),
	array('controller' => 'trademarks', 'action' => 'crud'),
	array('class' => 'new-item')
);
?>

<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('title', __('Nombre')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Trademark']['id']); ?></td>
				<td><?php echo h($item['Trademark']['name']); ?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'trademarks',
							'action' => 'crud',
							$item['Trademark']['id']
						),
						array(
							'class' => 'edit',
							'title' => __('Modificar')
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Eliminar'),
						array(
							'controller' => 'trademarks',
							'action' => 'delete',
							$item['Trademark']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar la marca «%s»?', $item['Trademark']['name'])
					);
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="paginator">
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Página {:page} de {:pages}')
));
?></p>

<div class="paging">
<?php
	echo $this->Paginator->prev('< Anterior', array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next('Siguiente >', array(), null, array('class' => 'next disabled'));
?>
</div>
</div>