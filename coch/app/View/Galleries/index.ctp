<h1><?php echo h(__('Listado de galerías')); ?></h1>

<?php
echo $this->Html->link(
	__('Nueva galería'),
	array('controller' => 'galleries', 'action' => 'data'),
	array('class' => 'new-item')
);
?>

<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('name', __('Nombre')); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Fecha')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Gallery']['id']); ?></td>
				<td><?php echo h($item['Gallery']['name']); ?></td>
				<td><?php echo h($item['Gallery']['created']); ?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar imágenes'),
						array(
							'controller' => 'galleries',
							'action' => 'crud',
							$item['Gallery']['id']
						),
						array(
							'class' => 'edit-picture',
							'title' => __('Modificar imágenes')
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'galleries',
							'action' => 'data',
							$item['Gallery']['id']
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
							'controller' => 'galleries',
							'action' => 'delete',
							$item['Gallery']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar la galería «%s»?', $item['Gallery']['name'])
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