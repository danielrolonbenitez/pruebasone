<h1><?php echo h(__('Armar newsletters')); ?></h1>
<h2>Elegir productos y ofertas</h2>

<div class="loading" id="loading" style="display: none">Cargando...</div>

<p><a href="" class="menu-item button" id="next-step">Continuar</a></p>

<table class="crud">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('name', __('Nombre')); ?></th>
			<th><?php echo $this->Paginator->sort('category_id', __('Categoría')); ?></th>
			<th>Incluir como producto</th>
			<th>Incluir como oferta</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $item) : ?>
			<tr>
				<td><?php echo h($item['Product']['id']); ?></td>
				<td><?php echo h($item['Product']['name']); ?></td>
				<td><?php echo h($item['Category']['title']); ?></td>
				<td class="actions">
					<input type="checkbox" name="add[]" value="<?php printf('%d', $item['Product']['id']); ?>">
				</td>
				<td class="actions">
					<input type="checkbox" name="ofr[]" value="<?php printf('%d', $item['Product']['id']); ?>">
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

<p><a href="" class="menu-item button" id="next-step-2">Continuar</a></p>

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
$("#paging a").click(function(e) {
	e.preventDefault();
	var ids = [];
	var ofr = [];
	$("input[type=\"checkbox\"][name=\"add[]\"]:checked,input[type=\"hidden\"][name=\"add[]\"]").each(function(e) {
		ids.push($(this).val());
	});
	$("input[type=\"checkbox\"][name=\"ofr[]\"]:checked,input[type=\"hidden\"][name=\"ofr[]\"]").each(function(e) {
		ofr.push($(this).val());
	});
	location.href = $(this).attr('href') + '#?ids=' + ids.join(',') + '&ofr=' + ofr.join(',');
});
if(location.hash.indexOf('#?') != -1) {
	var ids = location.hash.replace('#?ids=', '').replace(/\&ofr\=.*/, '').split(',');
	var ofr = location.hash.replace(/\#\?ids=.*\&ofr\=/, '').split(',');
	
	for(i=0;i<ids.length;i++) {
		var busca = $('input[name="add[]"][value="' + ids[i] + '"]');
		if(busca.length > 0) busca.attr("checked", "checked");
		else {
			var input = $("<input type=\"hidden\" />");
			input.attr("name", "add[]");
			input.attr("value", ids[i]);
			$("body").append(input);
		}
	}
	for(i=0;i<ofr.length;i++) {
		var busca = $('input[name="ofr[]"][value="' + ofr[i] + '"]');
		if(busca.length > 0) busca.attr("checked", "checked");
		else {
			var input = $("<input type=\"hidden\" />");
			input.attr("name", "ofr[]");
			input.attr("value", ofr[i]);
			$("body").append(input);
		}
	}
}
$("#next-step,#next-step-2").click(function(e) {
	e.preventDefault();
	var ids = [];
	var ofr = [];
	$("input[type=\"checkbox\"][name=\"add[]\"]:checked,input[type=\"hidden\"][name=\"add[]\"]").each(function(e) {
		ids.push($(this).val());
	});
	$("input[type=\"checkbox\"][name=\"ofr[]\"]:checked,input[type=\"hidden\"][name=\"ofr[]\"]").each(function(e) {
		ofr.push($(this).val());
	});
	location.href = '<?php echo h(Router::url('/newsletter/step2')); ?>?ids=' + ids.join(',') + '&ofr=' + ofr.join(',');
});
</script>