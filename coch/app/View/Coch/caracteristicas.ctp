<section>
	<nav class="section-navigation">
		<div class="container">
			<ul class="nav-menu-seccion">
				<li><a href="coch/presentacion/<?php printf('%d', $product['Product']['id']); ?>" class="azul FjO">C34<span class="rojodark">MAX</span></a></li>
				<li class="activo"><a href="coch/caracteristicas/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Caracter&iacute;sticas</a></li>
				<li><a href="coch/ficha_tecnica/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Ficha T&eacute;cnica</a></li>
				<li><a href="coch/p_imagenes/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Fotos</a></li>
				<li><a href="coch/p_videos/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Videos</a></li>
				<li><a href="coch/p_descargas/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Descargas</a></li>
			</ul>
			
		</div>
	</nav>
	<div class="secSlider secImgslim">
		<div class="secSliderTop"></div>
		<div class="secSliderBottom"></div>
		<div id="slideshow">
			<img src="files/<?php echo h($product['Product']['picture_thumb']);?>" alt="C34MAX"/>
			<div class="container">
				<div class="breadcrumbs"><h6><span class="selected">Productos</span> > <?php echo h($product['Product']['name_blue']);?><?php echo h($product['Product']['name_red']);?> > Caracter&iacute;sticas</h6></div>
				<div class="secTitulo">
					<h3 class="azul FjO"><?php echo h($product['Product']['name_blue']);?><span class="rojodark"><?php echo h($product['Product']['name_red']);?></span></h3>
					<h6 class="FjO"><?php echo h($product['Product']['slogan']);?></h6>
				</div>
			</div>
		</div>
	</div>
	<div class="secContent secProd">
		<aside class="secConMid">
			<div class="container secProdCarac">
				<div class="main left">
					<div class="grid_6"><h4 class="secTitulo azul FjO">CARACTER&Iacute;STICAS<br/>GENERALES</h4></div>
					<?php foreach($product['ProductFeature'] as $feature) : ?>
					<article class="grid_2 box">
						<div align="center"><img src="files/<?php echo h($feature['picture']); ?>" alt="" class="" width="290" /></div>
						<h5 class="rojodark FjO"><?php
						echo h(strtoupper(str_replace('á', 'Á', str_replace('é', 'É', str_replace('í', 'Í', str_replace('ó', 'Ó', str_replace('ú', 'Ú', $feature['title'])))))));
						?></h5>
						<p><?php echo h($feature['description']); ?></p>
					</article>
					<?php endforeach; ?>
					<div class="clearfix"></div>
				</div>
			</div>
		</aside>
	</div>
</section>
