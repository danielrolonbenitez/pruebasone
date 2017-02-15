<h1>Reordenar productos</h1>
<p>El reordenamiento es <strong>drag&drop</strong>, para reordenar hay que arrastrar el elemento y reacomodarlo en la posición deseada.</p>
<div class="columna">
	<div class="items" id="reorder">
		<?php 
		foreach($items as $item) {
			echo '<div class="item" data-id="' . sprintf('%d', $item['Product']['id']) . '">' . h($item['Product']['name']) . '</div>';
		}
		?>
	</div>
</div>

<script type="text/javascript">
var xhr_sort = null;
var sortable_opts = {
	"stop": function(event, ui) {
		
		var items = [];
		var elm = $("#reorder").find("div.item");
		elm.each(function() {
			items.push($(this).data("id"));
		});
		
		if(xhr_sort) {
			xhr_sort.abort();
			xhr_sort = null;
		}
		xhr_sort = $.ajax({
			"url": "<?php echo addslashes(Router::url('/products/reorder/do', true)); ?>",
			"type": "POST",
			"data": {
				'items': items
			}
		});
	}
};
$("#reorder").sortable(sortable_opts);

</script>