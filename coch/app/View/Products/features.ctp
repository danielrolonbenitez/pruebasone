<h1><?php echo h(__('Características de producto: ') . $product['Product']['name']); ?></h1>

<?php
echo $this->Html->link(
	__('Nueva característica'),
	'/products/feature_crud?product_id=' . $product['Product']['id'],
	array('class' => 'new-item')
);
?>


<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('title', __('Título')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['ProductFeature']['id']); ?></td>
				<td><?php echo h($item['ProductFeature']['title']); ?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'products',
							'action' => 'feature_crud',
							$item['ProductFeature']['id']
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
							'controller' => 'products',
							'action' => 'feature_delete',
							$item['ProductFeature']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar la característica «%s»?', $item['ProductFeature']['title'])
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
