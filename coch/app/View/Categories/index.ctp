<h1><?php echo h(__('Listado de categorías')); ?></h1>
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
	__('Nueva categoría'),
	array('controller' => 'categories', 'action' => 'crud'),
	array('class' => 'new-item')
);
?>

<table class="treetable" id="table-categories">
<?php foreach($categories as $category) : ?>  
	<tr data-tt-id="<?php printf('%d', $category['Category']['id']); ?>" <?php
	if($category['Category']['category_id']) echo ' data-tt-parent-id="' . h($category['Category']['category_id']) . '"';
	?>>
		<td>
			<span class="name"><?php echo h($category['Category']['name']); ?></span>
			<span class="edition">
				<?php
				echo $this->Html->link(
					__('Modificar'),
					array(
						'controller' => 'categories',
						'action' => 'crud',
						$category['Category']['id']
					),
					array(
						'class' => 'edit',
						'title' => __('Modificar categoría')
					)
				);
				
				echo $this->Html->link(
					__('Eliminar'),
					array(
						'controller' => 'categories',
						'action' => 'delete',
						$category['Category']['id']
					),
					array(
						'class' => 'remove',
						'title' => __('Eliminar')
					),
					__('¿Está seguro de eliminar la categoría «%s»?', $category['Category']['name'])
				);
				echo $this->Html->link(
					__('Agregar subcategoría'),
					array(
						'controller' => 'categories',
						'action' => 'add_child',
						$category['Category']['id']
					),
					array(
						'class' => 'add-child',
						'title' => __('Agregar subcategoría')
					)
				);
				?>
			</span>
			<div class="clear"></div>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<script type="text/javascript">
$(function() {
	$("#table-categories tr[data-tt-parent-id]").each(function() {
		var me = $(this);
		var id = me.data('tt-parent-id');

		var destination = $('tr[data-tt-id="' + id + '"] ');
		var nexts = 0;
		if(destination.data('next')) nexts = destination.data('next');
		destination.data('next', nexts + 1);
		for(i=0;i<nexts;i++) destination = destination.next();
		destination.after(me);
	});
	$("#table-categories").treetable({ expandable: true });
});
</script>

