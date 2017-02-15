<section>
		<nav class="section-navigation">
			<div class="container">
				&nbsp;
			</div>
		</nav>
		<div class="secSlider secImgslim novedades">
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
			<div id="slideshow" class="novedades <?php 
			if($page['Page']['id'] == 1) echo 'xq_coch';
			elseif($page['Page']['id'] == 2) echo 'coch_mundo';
			?>">
				<h1><span class="FjO"><?php 
			if($page['Page']['id'] == 1) echo '¿Por qué Coch?';
			elseif($page['Page']['id'] == 2) echo 'Coch en el mundo';
			?></span></h1>
			</div>
		</div>
		<div class="secContent secProd">
			<aside class="secConMid">
				<div class="container secProdCarac">
					<div class="main left">
						<div class="cp-breadcrumbs">
							Empresa &gt; <?php 
			if($page['Page']['id'] == 1) echo '¿Por qué Coch?';
			elseif($page['Page']['id'] == 2) echo 'Coch en el mundo';
			?>
						</div>
						<div class="custom-page">
						<?php
						echo $page['Page']['html_code'];
						?>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>