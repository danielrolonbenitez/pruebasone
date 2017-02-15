<section>
		<nav class="section-navigation">
			<div class="container">
				&nbsp;
			</div>
		</nav>
		<div class="secSlider secImgslim novedades">
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
			<div id="slideshow" class="novedades">
				<h1><span class="FjO">Novedades</span></h1>
			</div>
		</div>
		<div class="secContent secProd">
			<aside class="secConMid">
				<div class="container secProdCarac">
					<div class="main left">
						<a href="<?php echo h(Router::url('/coch/articles')); ?>" class="volver-a-noticias">&lt;&lt; Volver a noticias</a>
						
						<article class="lista-novedades novedad-principal">
							<time datetime="<?php echo h(date('Y-m-d', strtotime($article['Article']['created']))); ?>"><?php echo h(date('d/m/Y', strtotime($article['Article']['created']))); ?></time>
							<h1><span class="FjO"><?php echo h($article['Article']['title']); ?></span></h1>
							<img src="files/<?php echo h($article['Article']['picture_big']); ?>" alt="" class="main">
							<div class="descripcion">
								<?php echo $article['Article']['body']; ?>
							</div>
						</article>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>