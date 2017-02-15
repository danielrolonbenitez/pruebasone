//valida que se envie con enter//

$(document).on('keydown',function(e) {
    if (e.keyCode == 13) {
        $('#negocioForm').submit();
    }
});




$( "#negocioForm").submit(function(){
      
      $('#mensaje').find('.alert').remove();

	    var razonSocial=$("#razonSocial").val();
		var direccion=$("#direccion").val();
		var sitioWeb=$("#sitioWeb").val();
		var telefono=$("#telefono").val();
		var rubro=$("#rubro").val();
		var latitud=$("#latitud").val();
		

 if(razonSocial==""){


 $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Razon social!</strong> Por favor ingrese una Razon social.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);
           
 	
 	
 	return false;
 }



if(direccion==""){

  $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Dirección!</strong>Por favor ingrese una Dirección.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);


 	return false;
 }




/*if(sitioWeb !==""){

if( !/^www\.[a-zA-Z0-9\-]+\.+[a-zA-Z]/.test(sitioWeb)){

  $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Sitio Web</strong> Ingrese Un Formato Correcto.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);
  return false;
 }

}*/








if(telefono==""){
 $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Telefono!</strong> Por favor Ingrese un Numero Telefonico.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);
 	return false;
 }













if(!rubro){

 $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Rubro!</strong>Debe Agregar Al menos Un Rubro.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);
 	return false;
 }


if(latitud==""){

  $('#mensaje').append('<div class="alert alert-danger">'+
  '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
  '<strong>Mapa Ubicación!</strong> Marque su ubicación en el mapa.'+
'</div>')
  $('html, body').animate({
                    scrollTop: $("#mensaje").offset().top
                },0);
 	return false;
 }







});
