<h1><?php echo h(__('Listado de noticias')); ?></h1>
<?php

echo $this->Form->create('Article');
echo $this->Form->hidden('type', array('value' => 'search'));
echo $this->Form->input('title', array('label' => __('Buscar por título'), 'required' => false));
echo $this->Form->end(__('Buscar'));
?>

<?php
echo $this->Html->link(
	__('Nuevo artículo'),
	array('controller' => 'articles', 'action' => 'crud'),
	array('class' => 'new-item')
);
?>

<div class="loading" id="loading" style="display: none">Cargando...</div>

<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('title', __('Título')); ?></th>
			<th><?php echo $this->Paginator->sort('lead', __('Fecha de creación')); ?></th>
			<th style="white-space: nowrap"><?php echo $this->Paginator->sort('is_home', __('Mostrar en la home')); ?></th>
			<th><?php echo h(__('Acciones')); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Article']['id']); ?></td>
				<td><?php echo h($item['Article']['title']); ?></td>
				<td><?php echo h($item['Article']['created']); ?></td>
				<td style="width: 1%; text-align: center"><input
						type="radio"
						name="article-home"
						value="<?php echo h($item['Article']['id']); ?>"<?php
						if($item['Article']['in_home'] == 1) echo ' checked';
						?>></td>
				<td class="actions">
					<?php
					echo $this->Html->link(
						__('Modificar'),
						array(
							'controller' => 'articles',
							'action' => 'crud',
							$item['Article']['id']
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
							'controller' => 'articles',
							'action' => 'delete',
							$item['Article']['id']
						),
						array(
							'class' => 'delete',
							'title' => __('Eliminar')
						),
						__('¿Está seguro de eliminar el artículo «%s»?', $item['Article']['title'])
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

<script type="text/javascript">
$("input[name=\"article-home\"]").click(function(e) {
	var current = $("input[name=\"article-home\"]:checked").val();
	$("input[name=\"article-home\"]").attr("disabled", "disabled");
	$("#loading").fadeIn("fast");
	$.ajax({
		"url": "<?php echo Router::url('/articles/set_home_article/'); ?>" + current,
		"success": function() {
			$("input[name=\"article-home\"]").removeAttr("disabled");
			$("#loading").fadeOut("fast");
		}
	});
});
</script>