function split( val ) {
	return val.split( /,\s*/ );
}
function extractLast( term ) {
	return split( term ).pop();
}
jQuery(document).ready(function(){
	
	$('.aprobar').click(function(e){
		e.preventDefault();
		$button=jQuery(this);
		var id=$button.parent().closest('tr').data('id');
		var identidad=$button.parent().closest('tr').data('identidad');
		var id_identidad=$button.parent().closest('tr').data('id-identidad');
		var is_camara=$button.parent().closest('tr').data('is-camara');
		var url = '/mapa/came-form/form/aprobar/';
		
		if(identidad){
			$.post(url,{id:id},function(data){
				alert('Aprobada');
				 $button.parent().closest('tr').remove();
			});
		}else{
			$('.empty-modal').modal();
			$('input[name="id_actividad"]').val(id);
		}	
	});
	$('.rechazar').click(function(e){
		e.preventDefault();
		$button=jQuery(this);
		var id=jQuery(this).parent().closest('tr').data('id');
		var url = '/mapa/came-form/form/rechazar/';
		$.post(url,{id:id},function(data){
			alert('Rechazada');
			$button.parent().closest('tr').remove();
		});
	});
	$('#asignar').on('click',function(e){
		e.preventDefault();
		var id=jQuery('#id_actividad').val();
		var url = $('.empty-modal form').prop('action');
		var tosplit = $('#autocomplete').val();
		var camara = 0; 
		//tosplit = tosplit.split('-');
		//tosplit = split(tosplit);
		tosplit = tosplit.split('-');
		tosplit[3] = tosplit[3].trim(' ');
		if(tosplit[3].localeCompare('Camara')===0){
			camara = 1;
		}
		var _data = {
			"identidad":tosplit[1],
			"id_identidad":tosplit[2],
			"id_actividad":id,
			"is_camara":camara
		}
		$.post(url,_data,function(data){
			alert('Asignado');
			window.location.reload();
		});
	});
});