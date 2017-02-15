//$(document).ready(function(){

var anio=$('#anio').val();


 var parametros = {
               "anio" : anio,
                
        };
        $.ajax({
                data:  parametros,
                url:   'ajaxAnioPeriodo',
                type:  'get',
               beforeSend: function () {
                        
                },
                success:  function (response) {
           
                 var cant=response.length;
                    

                    for(i=0;i<cant;i++){


                      $('#periodo').append('<option value="'+response[i]['periodoNombre']+'" >'+response[i]['periodoNombre']+'</option>');

                  

                }





                }
        });














//});


