	<section>
		<nav class="section-navigation">
			<div class="container">
				&nbsp;
			</div>
		</nav>
		<div class="secSlider secImgslim novedades">
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
			<div id="slideshow" class="novedades coch_mundo">
				<h1><span class="FjO">Videos</span></h1>
			</div>
		</div>
		<div class="secContent secProd">
			<aside class="secConMid">
				<div class="container secProdCarac">
					<div class="main left">
						<?php /*<div class="grid_6"><h4 class="secTitulo azul FjO">VIDEOS</h4></div> */ ?>
						
						<?php foreach($videos as $item) : 
							$video = $item['Video'];
							$youtube_id = '';
							$match = array();

							$url = $video['youtube_url'];
							$url = preg_replace('/\?.*$/', '', $url);
							$url = preg_match('/tu\.be\/([a-zA-Z0-9\.\-\_\+]+)/', $url, $match);
							if($url) $youtube_id = $match[1];
							?>
						<div class="video-prod">
							<div class="vp-iframe">
								<iframe src="//www.youtube.com/embed/<?php echo h($youtube_id); ?>" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="vp-description"><?php echo h($video['description']); ?></div>
						</div>
						<?php endforeach; ?>
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>
