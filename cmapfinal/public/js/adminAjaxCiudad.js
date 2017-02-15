
$('select#provincia').on('change',function(){
   var valor = $(this).val();
 

       var parametros = {
               "valor" : valor,
                
        };
        $.ajax({
                data:  parametros,
                url:   'admin/ajaxCiudad',
                type:  'get',
               beforeSend: function () {
                        $('#ciudad').append('<option  selected="selected">cargando...</option>');
                },
                success:  function (response) {

                	console.log(response);
                	$('#ciudad').find('option').remove().end();//elimina los option que se cargan por default;

                	//console.log(response);

                 //$("#resultado").html(response);
                  //host=window.location+'/'+response;


                 //alert(host);

               //window.location=host;

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