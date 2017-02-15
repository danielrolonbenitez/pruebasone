<div class="normal-right">
	<a href="<?php echo Router::url('/novedades/'); ?>" class="volver-noticias">Volver a noticias</a>
	<article class="article-detail">
		<h1><?php echo h($article['Article']['title']); ?></h1>
		<img class="article-pic" src="<?php echo h(Router::url('/files/' . $article['Article']['picture'])); ?>">
		
		<div class="lead"><?php echo h($article['Article']['lead']); ?></div>
		<div class="body"><?php echo nl2br($article['Article']['body']); ?></div>
	</article>
</div>