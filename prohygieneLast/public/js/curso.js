
$(document).ready(function(){

var anio=$('#anio').val();


 var parametros = {
               "anio" : anio,
                
        };
        $.ajax({
                data:  parametros,
                url:   'ajaxAnioPeriodoInscripcion',
                type:  'get',
               beforeSend: function () {
                        
                },
                success:  function (response) {
                 
                 var response=response.reverse();

                for(i=0;i<response.length;i++){


                  $('#periodo').append('<option value="'+response[i]['periodoNombre']+'" >'+response[i]['periodoNombre']+'</option>');

               //console.log(cant);
               //console.log(response[0]['idCiudad']);

                }



			//carga el curso segun el periodo seleccionado la primera vez//
             loadCurso();

             //carga los usuario ya inscripto a un curso//

             yaInscripto();


                }
        });


//escucha cuado el select periodo  es cambiado y llama a la funcion //

$('#periodo').on('change',function(){
	//remueve todo lo cargado en la grilla//

$('#grilla').find('tbody').find('tr').remove();


	//remueve la fecha del curso//
$("#fecha").find("value").remove();

$("#fecha").attr("value","Fecha");

	loadCurso();

	yaInscripto();


});


/*carga los cursos campus*/
loadcursoscampus();













});//end document



<!--carga los cursos por ajax segun el periodo seleccionado-->


	
function loadCurso(){

var PeriodoNombre=$('#periodo option:selected').text();
var anio=$('#anio option:selected').text();



 var parametros = {
               "periodoNombre" : PeriodoNombre,
               "anio" : anio,
                
        };
        $.ajax({
                data:  parametros,
                url:   'ajaxLoadCursoInscripcion',
                type:  'get',
               beforeSend: function () {
                 
                },
                success:  function (response) {
                  
                    console.log(response);
                //remuevo todos los option antes de cargarlo//

                 $('#curso').find('option').not('#remove').not('.campus').remove();

          
           
                  //console.log(response);
           
             var cant=response.length;
                

                for(i=0;i<cant;i++){
                  var fecha=response[i]['fecha'];
                  fecha=fecha.split('-');
                  fecha=fecha[2]+'/'+fecha[1];


                  $('#curso').append('<option value="'+response[i]['idPeriodo']+'" >'+response[i]['nombre']+' '+'('+response[i]['destinado']+')'+' '+fecha+'</option>');

               //console.log(cant);
               //console.log(response[0]['idCiudad']);

                }





                }
        }); 




}//end load curso




















  



/* uso de jquery autocomplete y ajax para los campos de email*/

$("#email").on('keyup', function(){
									var valor=$(this).val();

									var uwp = {"valor" : valor,};

							         $.ajax({
												                data:  uwp,
												                url:   'listUsersWp',
												                type:  'get',
												               beforeSend: function () {
												                  //console.log("hello");  
												                },
												               success:  function (response) {
															      
															     var cant=response.length;          	
																
																//console.log(response);
																
																///carga el mail en un array para usarlo en el ajax autocomplete///
																//var i;	
																//var emailArray=[];			   

																	//for(i=0;i<cant;i++){
																		
																			//emailArray[i]=response[i]['email'];
																		
																		//}

																		//console.log(emailArray);
																			
																$("#email").autocomplete({ 
																	source: response

																 });//end autocomplete

																					
																	///end carga el mail en un array para usarlo en el ajax ///
																					
													    				  }//end succes
										 });//end ajax


								});//end users list

 


/**/







function guardar(){

	//almacena los alumno iscriptos por get//
	              
				   var curso=$("#curso").val();
				   var email=$("#email").val();
				   var skype=$("#skype").val();
				   var periodoNombre=$('#periodo').val();
				   var fecha=$('#fecha').val();
				   var cursoNombre=$("#curso option:selected").text();

			if(email==''){	 

			            
                  $('#content-mensaje').show(); 
                  $('#mensaje').html("Debe Ingresar Un Email");


				}else if(curso=='Cursos'){$('#content-mensaje').show(); $('#mensaje').html("Debe Seleccionar Un Curso");}

				else{

					 //begin ajax
				 var param = { "curso" : curso,"email" : email,"skype":skype,"periodoNombre":periodoNombre,"fecha":fecha,"cursoNombre":cursoNombre};




									 $.ajax({
									                data:  param,
									                url:   'storeForm',
									                type:  'get',
									               beforeSend: function () {
									                    
									                },
									               success:  function (data) {
												             
									               			//console.log(data);
                                                          if(data==2){
												             cargar();
												             $("#email").val('');//set val again to empty
												             $("#skype").val('');
												             //location.reload();
												             }else{$('#content-mensaje').show(); $('#mensaje').html(data);}	
												                    	 


												                    	 }//sucess
									        });


									 	// end ajax









				}//end else

				}//en guardar

















function  cargar(){

	       var cursoidperiodo=$('#curso').val();
            var param={'cursoval':cursoidperiodo};

		       $.ajax({
			                data:param,
			                url:   'ajaxLoadGrilla',
			                type:  'get',
			               beforeSend: function () {},
			               
			               success:  function (data) {
						                	
						         console.log(data);

						        addGrilla(data);   
                              
			                    
							}
        			});








}// en cargar


   



$('select#curso').on('change',function(){
										   
											var periodoNombre=$('#periodo').val();

										    var idPeriodo = $('#curso').val();
										    var anio=$('#anio').val();
										 
										   
										   var parametros = {
										   					"idPeriodo" : idPeriodo, 
										   					"periodoNombre":periodoNombre,
										   					"anio":anio,
															};
														        $.ajax({
														                data:  parametros,
														                url:   'ajaxFechaCurso',
														                type:  'get',
														               beforeSend: function () {
														                    
														                },
														               success:  function (response) {
																	                	
																		//console.log(response);
																		$("#fecha").find("value").remove();

																		$("#fecha").attr("value",response);


																            							}
														       		 });



										});//end select
						


//elimina de la grilla//



function eliminar(id){
$("#grilla").find(document.getElementById(id)).remove();
 var parametros= {"id" : id,};
        $.ajax({
                data:  parametros,
                url:   'ajaxDeleteGrilla',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (datos) {
			                	
                //remueve los datos ya estaban cargados        
                $(document.getElementById(datos)).remove();//remueve los datos cargados por ajax
			     //console.log(datos);
			                  
                          					}
       			 });

    
}







//agrega a la grilla//

function addGrilla(data)
{                             var nombre;
							  var rol;
                              var ciudad;
                              var pais;
                              var fecha;
                              cant=data.length;


                            for(i=0;i<cant;i++){
                            

                              if(data[i]["nombre"]==null){ nombre=data[i]["idPeriodoF"]; }else{nombre=data[i]["nombre"];}

                              if(data[i]["rol"]==""){ rol="Ninguno"; }else{rol=data[i]["rol"];}

                              if(data[i]["city"]==""){ ciudad="Ninguno"; }else{ciudad=data[i]["city"];}

                              if(data[i]["country"]==""){ pais="Ninguno"; }else{pais=data[i]["country"];}

                              if(data[i]["fecha"]==null){ fecha=data[i]["fechains"]; }else{fecha=data[i]["fecha"];}

                              


						    $("#grilla").find('tbody').append("<tr id='"+data[i]['idCursoInscripto']+"'><td class='setborder'>"+nombre+"</td><td class='setborder'>"+fecha+"</td><td class='setborder'>"+data[i]["email"]+"</td><td class='setborder'>"+rol+"</td><td class='setborder'>"+ciudad+"</td><td class='setborder'>"+pais+"</td><td class='setborder'>"+data[i]['skype']+"</td><td><i onclick='eliminar("+data[i]['idCursoInscripto']+")' class='glyphicon glyphicon-trash'></i></td></tr>");

						    }



}//end agrega ala grilla








function yaInscripto()
{
var PeriodoNombre=$('#periodo option:selected').text();
var anio=$('#anio option:selected').text();

//alert(PeriodoNombre);


 var parametros = {
               "periodoNombre" : PeriodoNombre,
               "anio" : anio,
                
        };



									 $.ajax({
									                data:  parametros,
									                url:   'ajaxYainscripto',
									                type:  'get',
									               beforeSend: function () {
									                    
									                },
									               success:  function (data) {
												             //console.log("inscripto");
									               			//console.log(data);

									               		

												            	 
									               						addGrilla(data); 

												                    	 }//sucess
									        });










}

///close modal botton////

$('#closeModal').on('click',function(){
$('#content-mensaje').hide();
$('#mensaje').html('');


});


/*carga lo cursos campos */
	
function loadcursoscampus(){




	$.ajax({
		
		url:   'ajaxloadcursocampus',
		type:  'get',
		beforeSend: function () {

		},
		success:  function (data) {

			//console.log(data.length);
       

       for(var i=0;i<data.length;i++){

       	  // console.log(data[i]['nombre']);
       	     

               $('#curso').append('<option class="campus" value="'+data[i]['nombre']+'">'+data[i]['nombre']+'</option>');
             
               //$x=$('#curso').val();


               //console.log($x);
               //console.log(response[0]['idCiudad']);

           }


}//sucess 

});





}

