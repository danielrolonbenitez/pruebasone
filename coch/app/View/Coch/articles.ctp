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
						<div class="nv-desc">En esta sección, enterate de las últimas noticias de Coch, como lanzamientos de nuevos productos o servicios, o novedades de la industria del procesamiento de piedras.</div>
						
						<?php
						$index = 0;
						foreach($articles as $article) : 
							$index++;
							?>
						<article class="lista-novedades">
							<a href="<?php
							echo h(Router::url('/coch/article/' . $article['Article']['id']));
							?>">
								<img src="files/<?php echo h($article['Article']['picture']); ?>" alt="">
								<time datetime="<?php echo h(date('Y-m-d', strtotime($article['Article']['created']))); ?>"><?php echo h(date('d/m/Y', strtotime($article['Article']['created']))); ?></time>
								<h1><span class="FjO"><?php echo h($article['Article']['title']); ?></span></h1>
								<div class="descripcion"><?php echo h($article['Article']['lead']);?></ ?></div>
								<span class="leer-mas" href="">Leer más &gt;&gt;</span>
							</a>
						</article>
						<?php 
							if($index % 2 == 0) {
								echo '<div style="clear: both"></div>';
								$index = 0;
							}
							
						endforeach; ?>
						
						<div class="paging-novedades">
						<?php
							echo $this->Paginator->prev('<< Anterior', array(), null, array('class' => 'prev disabled'));
							echo $this->Paginator->numbers(array('separator' => ''));
							echo $this->Paginator->next('Siguiente >>', array(), null, array('class' => 'next disabled'));
						?>
						</div>
						
						
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>
