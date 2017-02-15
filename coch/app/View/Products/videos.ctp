<h1><?php echo h(__('Videos de producto: ') . $product['Product']['name']); ?></h1>

<?php
echo $this->Html->link(
	__('Nuevo video'),
	'/products/video_crud?product_id=' . $product['Product']['id'],
	array('class' => 'new-item')
);
?>


<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('description', __('Descripción')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['ProductVideo']['id']); ?></td>
				<td><?php
				if(strlen($item['ProductVideo']['description']) > 50) {
					$desc = substr($item['ProductVideo']['description'], 0, 50) . '...';
				}
				else $desc = $item['ProductVideo']['description'];
				
				echo h($desc);
				?></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'products',
							'action' => 'video_crud',
							$item['ProductVideo']['id']
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
							'action' => 'video_delete',
							$item['ProductVideo']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar este video')
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
