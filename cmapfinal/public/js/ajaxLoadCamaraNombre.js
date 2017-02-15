$("#clave").on('click', function(){
									var valor=$(this).val();

									var uwp = {"valor" : valor,};

							         $.ajax({
												                data:  uwp,
												                url:   'ajaxCamara',
												                type:  'get',
												               beforeSend: function () {
												                  
												                },
												               success:  function (response) {
															      

															     alert("hole");
																			
																//$("#clave").autocomplete({ 
																	
																	//source: response

																 //});//end autocomplete

																					
																	///end carga el mail en un array para usarlo en el ajax ///
																					
													    				  }//end succes
										 });//end ajax


								});//end users list

