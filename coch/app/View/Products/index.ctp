<h1><?php echo h(__('Listado de productos')); ?></h1>
<?php

$this->Html->css('jquery.treetable', 'stylesheet', array('block' => 'script'));
echo $this->Html->script('jquery.treetable');


echo $this->Form->create('Product');
echo $this->Form->hidden('type', array('value' => 'search'));
echo $this->Form->input('name', array('label' => __('Texto a buscar')));
echo $this->Form->end(__('Buscar'));
?>

<?php if(!empty($_POST)) : ?>
<a class="back-button" href="<?php echo h(Router::url('/products/')); ?>">
	<span class="icon"></span>
	<span class="text">Volver</span>
</a>
<?php endif; ?>
<?php
echo $this->Html->link(
	__('Nuevo producto'),
	array('controller' => 'products', 'action' => 'crud'),
	array('class' => 'new-item')
);
echo ' - ';
echo $this->Html->link(
	__('Reordenar'),
	array('controller' => 'products', 'action' => 'reorder'),
	array('class' => 'new-item', 'style' => 'background-image: url(../img/gears.png)')
);
?>
<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('name', __('Nombre')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Product']['id']); ?></td>
				<td><?php echo h($item['Product']['name']); ?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'products',
							'action' => 'crud',
							$item['Product']['id']
						),
						array(
							'class' => 'edit',
							'title' => __('Modificar')
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Imágenes'),
						array(
							'controller' => 'products',
							'action' => 'gallery_index',
							$item['Product']['id']
						),
						array(
							'class' => 'edit-picture'
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Videos'),
						array(
							'controller' => 'products',
							'action' => 'videos',
							$item['Product']['id']
						),
						array(
							'class' => 'video'
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Características'),
						array(
							'controller' => 'products',
							'action' => 'features',
							$item['Product']['id']
						),
						array(
							'class' => 'gears'
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Descargas'),
						array(
							'controller' => 'products',
							'action' => 'downloads',
							$item['Product']['id']
						),
						array(
							'class' => 'edit-downloads'
						)
					);
					echo ' ';
					echo $this->Html->link(
						__('Eliminar'),
						array(
							'controller' => 'products',
							'action' => 'delete',
							$item['Product']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar el producto «%s»?', $item['Product']['name'])
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
