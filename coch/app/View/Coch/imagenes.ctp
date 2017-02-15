<?php

$this->Html->css('jquery.fancybox-1.3.4', 'stylesheet', array('block' => 'scriptTop'));
$this->Html->script('jquery.fancybox-1.3.4.pack', array('block' => 'scriptBottom'));

?><section>
		<nav class="section-navigation">
			<div class="container">
				&nbsp;
			</div>
		</nav>
		<div class="secSlider secImgslim novedades">
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
			<div id="slideshow" class="novedades xq_coch">
				<h1><span class="FjO">Im&aacute;genes</span></h1>
			</div>
		</div>
		<div class="secContent secProd">
			<aside class="secConMid">
				<div class="container secProdCarac">
					<div class="main left">
						
						
						<div class="image-grid">
							<?php foreach($pictures as $item) :
								$picture = $item['Picture'];
								?>
							<a rel="gallery" href="files/<?php echo h($picture['file_big']); ?>" class="picture" title="<?php echo h($picture['description']); ?>">
								<span class="description">
									<span class="background"></span>
									<span class="icon"></span>
									<span class="text"><?php echo h($picture['description']); ?></span>
								</span>
								<img src="files/<?php echo h($picture['file_name']); ?>" alt="" class="la-imagen">
							</a>
							<?php endforeach; ?>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>
<script type="text/javascript">
$(function() {
	$("a[rel=\"gallery\"]").fancybox();
});
</script>