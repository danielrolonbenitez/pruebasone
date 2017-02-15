<h1><?php echo h(__('Listado de clientes')); ?></h1>
<?php
echo $this->Html->link(
	__('Nuevo cliente'),
	array('controller' => 'clients', 'action' => 'crud'),
	array('class' => 'new-item')
);
?>

<div class="loading" id="loading" style="display: none">Cargando...</div>

<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('name', __('Nombre')); ?></th>
			<th><?php echo $this->Paginator->sort('surname', __('Apellido')); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Fecha de creación')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Client']['id']); ?></td>
				<td><?php echo h($item['Client']['name']); ?></td>
				<td><?php echo h($item['Client']['surname']); ?></td>
				<td><?php echo date('d/m/Y H:i:s', strtotime($item['Client']['created'])); ?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'clients',
							'action' => 'crud',
							$item['Client']['id']
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
							'controller' => 'clients',
							'action' => 'delete',
							$item['Client']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar el cliente «%s»?', $item['Client']['name'])
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