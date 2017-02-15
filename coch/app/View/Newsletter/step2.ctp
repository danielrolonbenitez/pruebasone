<h1><?php echo h(__('Armar newsletters')); ?></h1>
<h2>Elegir artículos</h2>

<div class="loading" id="loading" style="display: none">Cargando...</div>


<a href="" class="menu-item button" id="next-step">Continuar</a>
<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('name', __('Título')); ?></th>
			<th><?php echo $this->Paginator->sort('date', __('Fecha')); ?></th>
			<th>Incluir</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Article']['id']); ?></td>
				<td><?php echo h($item['Article']['title']); ?></td>
				<td><?php echo date('d/m/Y H:i', strtotime($item['Article']['created'])); ?></td>
				<td class="actions">
					<input type="checkbox" name="art[]" value="<?php printf('%d', $item['Article']['id']); ?>">
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

<div class="paging" id="paging">
<?php
	echo $this->Paginator->prev('< Anterior', array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next('Siguiente >', array(), null, array('class' => 'next disabled'));
?>
</div>
</div>

<a href="" class="menu-item button" id="next-step-2">Continuar</a>

<script type="text/javascript">
$("#paging a").click(function(e) {
	e.preventDefault();
	var art = [];
	$("input[type=\"checkbox\"][name=\"art[]\"]:checked,input[type=\"hidden\"][name=\"art[]\"]").each(function(e) {
		art.push($(this).val());
	});
	location.href = $(this).attr('href') + '#&art=' + art.join(',');
});
if(location.hash.indexOf('#&art=') != -1) {
	var art = location.hash.replace('#&art=', '').split(',');
	
	for(i=0;i<art.length;i++) {
		var busca = $('input[name="art[]"][value="' + art[i] + '"]');
		if(busca.length > 0) busca.attr("checked", "checked");
		else {
			var input = $("<input type=\"hidden\" />");
			input.attr("name", "art[]");
			input.attr("value", art[i]);
			$("body").append(input);
		}
	}
}
$("#next-step,#next-step-2").click(function(e) {
	e.preventDefault();
	var art = [];
	$("input[type=\"checkbox\"][name=\"art[]\"]:checked,input[type=\"hidden\"][name=\"art[]\"]").each(function(e) {
		art.push($(this).val());
	});
	
	location.href = '<?php echo h(Router::url('/newsletter/name')); ?>?ids=<?php echo $_GET['ids']; ?>&ofr=<?php echo $_GET['ofr']; ?>&art=' + art.join(',');
});
</script>