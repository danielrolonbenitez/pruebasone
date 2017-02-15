<footer>
        <div class="container">
		<div class="module module01">
			<h4 class="FjO">&iquest;POR QU&Eacute; COCH?</h4>
			<p><?php echo substr(strip_tags($why_coch['Page']['html_code']), 0, 145) . '...'; ?></p>
			<a href="<?php echo h(Router::url('/coch/page/1')); ?>" class="link02">leer m&aacute;s</a>
			<img src="images/coch05.png" alt="" />
		</div>
		<div class="module module02">
			<h4 class="FjO">COCH EN EL MUNDO</h4>
			<p><?php echo substr(strip_tags($coch_world['Page']['html_code']), 0, 145) . '...'; ?></p>
			<a href="<?php echo h(Router::url('/coch/page/2')); ?>" class="link02">leer m&aacute;s</a>
			<img src="images/coch06.png" alt="" />
		</div>
		<div class="module module03">
			<h4 class="FjO">H&Aacute;GANOS SU CONSULTA</h4>
			<div class="formSuConsulta">
				<form id="formConsulta" name="formConsulta" method="post" action="<?php echo h(Router::url('/coch/contacto/1', true)); ?>">
					<div>
						<label for="FC_name">Su nombre</label>
						<span><input type="text" name="FC_c_name" id="FC_name" class="fc_txt" /></span>
					</div>
					<div>
						<label for="FC_email">Su E-Mail</label>
						<span><input type="text" name="FC_c_email" id="FC_email" class="fc_txt" /></span>
					</div>
					<div>
						<label for="FC_mensage">Su Consulta</label>
						<span><textarea name="FC_c_mensaje" id="FC_mensage" cols="45" rows="1" class="fc_txt"></textarea></span>
						<input type="submit" name="FC_button" id="FC_button" value="ENVIAR" class="link03" />
					</div>
				</form>
			</div>
		</div>
		<div class="moduleFull">
			<p>Copyright &copy; 2013 Coch - Todos los derechos reservados - Web Design: ArcaCrea</p>
			<p>COCH S.A. Ruta Panamericana Km. 31 &#8226; B1618FBN &#8226; El Talar &#8226; Buenos Aires &#8226; Argentina, Tel. (54-11) 4726-7878 &#8226; Fax (54-11) 4726-9491 &#8226; <a href="mailto:coch@coch.com.ar">coch@coch.com.ar</a></p>
		</div>
        </div>
</footer>
<div id="loading-item" style="display: none"></div>


<script type="text/javascript" src="js/cufon-yui.js"></script>
<!--<script type="text/javascript" src="js/Fjalla_One_400.font.js"></script-->
<!--<script type="text/javascript" src="js/wowscript-fade.js"></script>-->
<script type="text/javascript" src="js/jquery.uniform.js"></script>
<script type="text/javascript" src="js/droppy.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.global.js"></script>
<?php echo $this->fetch('scriptBottom'); ?>