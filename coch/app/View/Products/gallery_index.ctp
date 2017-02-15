<h1><?php echo h(__('Editar imágenes del producto')); ?></h1>

<?php
/*echo $this->Form->create('Gallery', array('enctype' => 'multipart/form-data'));
if(!empty($this->data)) echo $this->Form->input('id');
echo $this->Form->input('name', array('label' => __('Nombre')));*/ ?>


<h2><?php echo h(__('Agregar imagen nueva')); ?></h2>

<form action="<?php echo Router::url('/products/gallery_picture_new'); ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="post" value="post">
	<input type="hidden" name="product_id" value="<?php printf('%d', $id); ?>">
	<input type="file" name="picture" onchange="this.parentNode.submit()">
	<br>&nbsp;
</form>

<h2><?php echo h(__('Modificar imágenes')); ?></h2>
<div class="gallery" id="gallery">
	<?php if($data) foreach($data as $picture) : ?>
	<a href="<?php echo Router::url('/products/gallery_picture_crud/' . sprintf('%d', $picture['ProductPicture']['id'])); ?>" class="iframe" data-id="<?php printf('%d', $picture['ProductPicture']['id']); ?>">
		<span class="order"></span>
		<span class="nosort">
			<span class="align-hack"></span>
			<span class="img">
				<img src="<?php echo Router::url('/'); ?>files/<?php echo h($picture['ProductPicture']['file_name']); ?>" alt="">
			</span>
		</span>
	</a>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>


<?php /* echo $this->Form->end(__('Guardar')); */ ?>



<script type="text/javascript">
var index = 1;
$("#gallery a").each(function() {
	$(this).find("span.order").text(index);
	index++;
});
$("#gallery").sortable({
	"cursor": "move",
	"items": "a",
	"cancel": "span.nosort",
	"start": function() {
		$(this).find("span.order").fadeOut("fast");
	},
	"stop": function() {
		$(this).find("span.order").fadeIn("fast");
		index = 1;
		
		var ids = [];
		$("#gallery a").each(function() {
			$(this).find("span.order").text(index);
			index++;
			ids.push($(this).data("id"));
		});
		
		$.ajax({
			"url": "<?php echo addslashes(Router::url('/products/gallery_reorder', true)); ?>",
			"type": "POST",
			"data": {
				"id": ids
			}
		});
	}
});
$("#gallery a.iframe").fancybox({
	"height": 200
});
function deletePicture(id) {
	$("#gallery a[data-id=" + id + "]").remove();
	$("#gallery").sortable("refresh");
	$.ajax({
		"url": "<?php echo addslashes(Router::url('/products/gallery_picture_delete', true)); ?>",
		"type": "POST",
		"data": {
			"id": id
		}
	});
}
</script>