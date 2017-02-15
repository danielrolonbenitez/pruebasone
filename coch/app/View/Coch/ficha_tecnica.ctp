<section>
	<nav class="section-navigation">
		<div class="container">
			<ul class="nav-menu-seccion">
				<?php /*<li><a href="coch/presentacion/<?php printf('%d', $product['Product']['id']); ?>" class="azul FjO">C34<span class="rojodark">MAX</span></a></li> */ ?>
				<li><a href="coch/presentacion/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Caracter&iacute;sticas</a></li>
				<li class="activo"><a href="coch/ficha_tecnica/<?php printf('%d', $product['Product']['id']); ?>" class="FjO">Ficha T&eacute;cnica</a></li>
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
				<div class="breadcrumbs"><h6><span class="selected">Productos</span> > <?php echo h($product['Product']['name_blue']);?><?php echo h($product['Product']['name_red']);?> > Ficha T&eacute;cnica</h6></div>
				<div class="secTitulo">
					<h3 class="azul FjO"><?php echo h($product['Product']['name_blue']);?><span class="rojodark"><?php echo h($product['Product']['name_red']);?></span></h3>
					<h6 class="FjO"><?php echo h($product['Product']['slogan']);?></h6>
				</div>
			</div>
		</div>
	</div>
	<div class="secContent secProd">
		<aside class="secConMid">
			<div class="container secProdFT">
				<div class="main left">
					<article class="grid_6">
						<h4 class="secTitulo azul FjO">FICHA<br/>T&Eacute;CNICA</h4>
						<table width="760" border="0" cellspacing="0" cellpadding="0" class="fTecnica">
						<?php foreach($product['ProductSpec'] as $spec) : ?>
						  <tr class="even">
						    <td width="30">&nbsp;</td>
						    <td width="260" align="left" class="titulo"><?php echo h($spec['name']); ?></td>
						    <td width="200" align="right"><?php echo h($spec['value']); ?></td>
						    <td width="220" align="right"><?php echo h($spec['value_2']); ?></td>
						    <td width="50">&nbsp;</td>
						  </tr>
						  <tr><td height="2" colspan="5"></td></tr>
						  <?php endforeach; ?>
						</table>
						<?php foreach($product['ProductSpecPic'] as $pic) : ?>
						<img src="files/<?php echo h($pic['picture']); ?>" alt="" />
						<?php endforeach; ?>
					</article>
					<div class="clearfix"></div>
				</div>
			</div>
		</aside>
	</div>
</section>
