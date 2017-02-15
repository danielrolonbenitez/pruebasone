<div class="box-title">
	<h3>Exportar</h3>
</div>
<div class="box-content nopadding">
	<ul class="list-group">
		<!-- <li class="list-group-item"><a href="#" data-href="index.php?a=exportar&action=listado-completo-por-codigo">Listado completo ordenado por c&oacute;digo</a></li> -->
		<li class="list-group-item"><a href="#" data-href="index.php?a=exportar&action=listado-completo-por-nombre">Listado completo ordenado alfab&eacute;ticamente</a></li>
		<!--  <li class="list-group-item"><a href="#" data-href="index.php?a=exportar&action=listado-completo-por-eje">Listado completo separado en solapas por eje tem&aacute;tico</a></li> -->
		<li class="list-group-item">
			<a id="comision" href="#" class="por-comision" data-href="">Listado completo separado en solapas por eje tem&aacute;tico por comisi&oacute;n por cantidad de asistentes</a>
		</li>
	</ul>
	<div class="navbar-form navbar-left hidden" >
		<div class="form-group">
			<label for="cantidad">Ingrese una cantidad prefijada de asistentes por comisión</label>
			<input type="text" style="max-width:10%" placeholder="500" value="" name="cantidad" id="cant" class="form-control">
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#comision').on('click',function(){
	  $('.navbar-form.navbar-left').removeClass('hidden');
	});
	$('#cant').change(function(){
		var valor = $(this).val();
		var href='index.php?a=exportar&action=listado-completo-por-eje-por-comision&cantidad='+valor;
		$('#comision').data('href',href);
	});
	$('ul.list-group li a').on('click',function(){
			if($(this).data('href').length>0){
				$.get($(this).data('href'),function(data){
					console.log(data);
					download(data);
				});
			}
	  
	});
        
});
function download(fileurl){
	$.fileDownload(fileurl, {
		successCallback: function(url) {

			$preparingFileModal.dialog('close');
		},
		failCallback: function(responseHtml, url) {

			$preparingFileModal.dialog('close');
			$("#error-modal").dialog({ modal: true });
		}
	});	
}
</script>
