//deseleciona origen y selecciona rubros//





//enviar formulario//
function enviarForm()
{
   var rubro=$('#rubro').val();
      if(rubro===null){ alert("RUBRO:debe volver a seleccionar a todos los rubros al que pertenece");  }else{$('#negocioForm').submit();}
}


function cambiarEstado(){

$checked=$("#estado").is(':checked');
if($checked==false){

	$("#estado").attr('value','0');
}else{$("#estado").attr('value','1');}



}




//pasa los rubros//
		$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#rubro'); });  
		$('.quitar').click(function() { $('#rubro option').remove().appendTo('#origen');$("#origen").find('option').removeAttr('selected');$("#rubro").find('option').removeAttr('selected');$("#rubro").find('option').attr('selected','selected');});
		$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#rubro'); }); });
		$('.quitartodos').click(function() { $('#rubro option').each(function() { $(this).remove().appendTo('#origen'); }); });
		


$('select#provincia').on('change',function(){
   var valor = $(this).val();
 

       var parametros = {
               "valor" : valor,
                
        };
        $.ajax({
                data:  parametros,
                url:   '../admin/ajaxCiudad',
                type:  'get',
               beforeSend: function () {
                        $('#ciudad').append('<option  selected="selected">cargando...</option>');
                },
                success:  function (response) {

                	$('#ciudad').find('option').remove().end();//elimina los option que se cargan por default;

                
               var cant=response.length;//obtengo la cantidad
               var i;

               	for(i=0;i<cant;i++){


               		$('#ciudad').append('<option value="'+response[i]['idCiudad']+'" selected="selected">'+response[i]['nombre']+'</option>');

               //console.log(cant);
               //console.log(response[0]['idCiudad']);

               	}





                }
        });


});//cierra funcion principal




