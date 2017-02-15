<div class="normal-right">
	<div class="noticias-h1">Noticias ADM</div>
	<div class="article-list">
		<?php foreach($data as $article) : ?>
		<article>
			<a href="<?php
			echo h(Router::url('/novedades/ver/' . Inflector::slug($article['Article']['title']) . '-' . $article['Article']['id'] . '.html', true));
			?>" class="article-pic"><img src="<?php echo h(Router::url('/files/' . $article['Article']['picture'])); ?>"></a>
			<div class="info">
				<h1><a href="<?php
			echo h(Router::url('/novedades/ver/' . Inflector::slug($article['Article']['title']) . '-' . $article['Article']['id'] . '.html', true));
			?>"><?php echo h($article['Article']['title']); ?></a></h1>
				<div class="lead"><div><?php echo h($article['Article']['lead']); ?></div></div>
				<a href="<?php
			echo h(Router::url('/novedades/ver/' . Inflector::slug($article['Article']['title']) . '-' . $article['Article']['id'] . '.html', true));
			?>" class="more-info">+ info</a>
			</div>
		</article>
		<?php endforeach; ?>
	</div>
	
	<div class="pagination">
		<?php echo $this->Paginator->numbers(array('separator' => ' - ')); ?>
	</div>
</div>
<script type="text/javascript">
$("article div.lead").each(function() {
	var child = $(this).find('div');
	while(child.height() > $(this).height()) {
		var text = child.text().substr(0, child.text().length - 5);
		child.text(text + '...');
	}
});
</script>