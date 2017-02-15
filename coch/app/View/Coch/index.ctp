<?php

/*<script type="text/javascript" src="js/wowslider.js"></script>
<script type="text/javascript" src="js/wowsliderscript.js"></script>
*/

$this->Html->script('wowslider', array('block' => 'scriptBottom'));
$this->Html->script('wowsliderscript', array('block' => 'scriptBottom'));

?><section>
		<nav class="section-navigation">
			<div class="container"></div>
		</nav>
		<div class="secSlider secHSlider">
			<div id="slideshow">
				<div class="container">
					<aside id="wowslider-container1" class="slide">
						<div class="ws_images">
							<ul>
								<li>
									<img src="images/home/slide01.jpg" alt="MÁQUINAS DE CALIDAD PARA LA INDUSTRIA DEL MÁRMOL Y EL GRANITO" id="wows0"/>
									<div class="wows0"><h2 class="shadow">M&Aacute;QUINAS DE CALIDAD<br/>PARA LA INDUSTRIA<br/><span class="gris">DEL M&Aacute;RMOL Y EL GRANITO</span></h2><h5 class="shadow">Cortadoras, pulidoras, perforadoras, calibradoras, biseladoras y accesorios.</h5></div>
								</li>
								<li>
									<img src="images/home/slide02.jpg" alt="INGENIERÍA Y FORTALEZA" id="wows1"/>
									<div class="wows1"><h1 class="left shadow">INGENIER&Iacute;A<br/>Y FORTALEZA</h1><h5 class="bgrojo right">Nuestros productos simplifican, agilizan y mejoran los procesos productivos.</h5></div>
								</li>
								<li>
									<img src="images/home/slide03.jpg" alt="TECNOLOGÍA DE PRECISI�N" id="wows2"/>
									<div class="wows2"><h1 class="azul">TECNOLOG&Iacute;A<br/>DE PRECISI&Oacute;N</h1><h3 class="rojo">PARA LA INDUSTRIA DEL PROCESAMIENTO DE PIEDRAS</h3><h5 class="left bgazul">Continuo desarrollo de nuevos productos y amplia capacidad tecnol&oacute;gica.</h5></div>
								</li>
								<li>
									<img src="images/home/slide04.jpg" alt="" id="wows3"/>
									<div class="wows3"><h3 class="shadow">LA MEJOR SOLUCI&Oacute;N<small class="gris">PARA SU MARMOLER&Iacute;A</small></h3></div>
								</li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
		</div>
		<div class="secContent secHContent">
			<div class="secConTop">
				<div class="container" id="content">
					<div class="main left">
						<img src="files/<?php echo h($featured_article['Article']['picture']); ?>" alt="" class="left" style="width: 280px; height:200px" />
						<div class="mainTxt left">
							<h6>NOVEDADES</h6>
							<h3>
								<span><?php echo h(date('d/m/Y', strtotime($featured_article['Article']['created']))); ?></span>
								<a href="<?php echo h(Router::url('/coch/article/' . $featured_article['Article']['id'], true)); ?>"><?php echo h($featured_article['Article']['title']); ?></a>
							</h3>
							<p><?php echo h($featured_article['Article']['lead']); ?></p>
							<a href="<?php echo h(Router::url('/coch/article/' . $featured_article['Article']['id'], true)); ?>" class="link01">Leer m&aacute;s</a>
						</div>
					</div>
					<div class="sidebar right">
						<h5 class="gris">Suscr&iacute;base a nuestro</h5>
						<h4>NEWSLETTER</h4>
						<p>Reciba mensualmente todas las novedades sobre Coch y el rubro del procesamiento de piedras.</p>
						<div class="formNewsletter">
							<form id="formNews" name="formNews" method="post" action="coch/add_newsletter">
								<div>
									<label for="FN_email">Ingrese su E-Mail</label>
									<input type="text" name="email" id="FN_email" />
									<input type="submit" name="FN_button" id="FN_button" value="Enviar" class="link01" />
								</div>
							</form>
							<script type="text/javascript">
$("#formNews").submit(function(e) {
	e.preventDefault();
	$("#loading-item").clearQueue().fadeIn();
	$("#formNews").ajaxSubmit({
		"dataType": "json",
		"success": function(e) {
			$("#loading-item").clearQueue().fadeOut();
			if(e.status && e.status == 'ok') {
				$("#formNews")[0].reset();
				alert("Gracias por suscribirse.");
			}
			else alert(e.message);
		},
		"error": function() {
			$("#loading-item").clearQueue().fadeOut();
			alert("Ocurrió un error. Por favor, inténtelo de nuevo más adelante.");
		}
	});
});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>