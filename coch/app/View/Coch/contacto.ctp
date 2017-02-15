<section>
		<nav class="section-navigation">
			<div class="container">
				&nbsp;
			</div>
		</nav>
		<div class="secSlider secImgslim novedades">
			<div class="secSliderTop"></div>
			<div class="secSliderBottom"></div>
			<div id="slideshow" class="novedades contacto">
				<h1><span class="FjO">Contacto</span></h1>
			</div>
		</div>
		<div class="secContent secProd">
			<aside class="secConMid">
				<div class="container secProdCarac">
					<div class="main left">
						
						
						<div class="m-contacto">
							<span class="pais">
								<span class="FjO">Argentina</span>
								<span class="telefono">54 11 4726 7878</span>
								<a class="email" href="mailto:coch@coch.com.ar">coch@coch.com.ar</a>
							</span><span class="pais brasil">
								<span class="FjO">Brasil</span>
								<span class="telefono">55 11 3042 3967</span>
								<a class="email" href="mailto:coch@cochbrasil.com.br">coch@cochbrasil.com.br</a>
							</span><span class="pais estados_unidos">
								<span class="FjO">Estados Unidos</span>
								<span class="telefono">1 772 201 2243</span>
								<a class="email" href="mailto:coch@coch.us">coch@coch.us</a>
							</span>
							
							<form id="formConsulta2" method="POST" action="">
								<h1 class="FjO">Formulario de consulta</h1>
								Hacenos tu consulta a través del formulario, seleccionando el sector correspondiente:
								
								<div class="checkboxes">
									<label>
										<input type="radio" name="sector" value="services" checked>
										Servicios
									</label>
									<label>
										<input type="radio" name="sector" value="commercial">
										Comercial
									</label>
									<label>
										<input type="radio" name="sector" value="management">
										Administración
									</label>
								</div>
								
								
								<div>
									<label for="FC_c_name">Nombre y apellido</label>
									<span><input type="text" class="fc_txt" id="FC_c_name" name="FC_c_name"></span>
								</div>
								<div>
									<label for="FC_c_company">Empresa</label>
									<span><input type="text" class="fc_txt" id="FC_c_company" name="FC_c_company"></span>
								</div>
								<div>
									<label for="FC_c_phone">Teléfono</label>
									<span><input type="text" class="fc_txt" id="FC_c_phone" name="FC_c_phone"></span>
								</div>
								<div>
									<label for="FC_c_email">E-Mail</label>
									<span><input type="text" class="fc_txt" id="FC_c_email" name="FC_c_email"></span>
								</div>
								<div>
									<label for="FC_c_mensaje">Su Consulta</label>
									<span><textarea class="fc_txt" rows="1" cols="45" id="FC_c_mensaje" name="FC_c_mensaje"></textarea></span>
								</div>
								<div class="enviar-form">
									<button type="submit" class="FjO">Enviar</button>
								</div>
							</form>
						</div>
						
						
						
						
						<div class="clearfix"></div>
					</div>
				</div>
			</aside>
		</div>
	</section>
<script type="text/javascript">
$(function() {	
	var sending = false;
	$("#formConsulta2").submit(function(e) {
		e.preventDefault();
		if(!sending) {
			sending = true;
			$("*").css("cursor", "wait");
			$("#formConsulta2").ajaxSubmit({
				"dataType": "json",
				"success": function(e) {
					sending = false;
					$("*").css("cursor", "");

					if(e.status == 'error') alert(e.message);
					else {
						$("#formConsulta2")[0].reset();
						$("#formConsulta2 input, #formConsulta2 textarea").blur();
						alert("Gracias por ponerse en contacto con nosotros.");
						/*$.fancybox({
							"type": "iframe",
							"href": "<?php echo Router::url('/', true); ?>adm/popup_contacto",
							"padding": 0,
							"margin": 0,
							"width": 413,
							"height": 224,
							"showCloseButton": false
						});*/
					}
				},
				"error": function(e) {
					sending = false;
					$("*").css("cursor", "");

					alert("Ocurrió un error desconocido. Por favor inténtelo más tarde.");
				}
			});
		}
	});
});
	</script>