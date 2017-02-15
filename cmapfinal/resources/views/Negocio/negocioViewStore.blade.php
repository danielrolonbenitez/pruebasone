@extends('app')
@section('content')

            <!---begin contain form-->
      <div class="row">

		
<!--Mensaje-->
				@if (count($errors) > 0)
												    <div class="alert alert-danger">
												    <button type="button" class="close" data-dismiss="alert">&times;</button>
												        <ul>


												            @foreach ($errors->all() as $error)
												                <li>{{ $error }}</li>
												            @endforeach
												        </ul>
												    </div>
													@endif


			
				<!--Mensaje-->




      	<div  class="col-lg-8 col-lg-offset-2" style="background:rgba(0,0,0,0.5);padding:50px;color:white;">

				<div id="mensaje"></div>



				<form  class="" role="form"    id="negocioForm" action="{{route('negocioStore')}}" method="POST" enctype="multipart/form-data" >
								
				<div class="row"> 
                                             
									<div class="col-lg-5">
                                             <input type="hidden" name="_token" value="{{ csrf_token() }}" />
												<input type="hidden" name="latitud" id="latitud" value="" />
												<input type="hidden" name="longitud" id="longitud" value="" />
											 

							
											    <label for="razonSocial" id="razonDisplay">Razon Social:</label><br>
											    <input type="text" class="form-control" name="razonSocial" id="razonSocial" placeholder="Razon Social" ><br></br>
											  
											    <label for="direccion">Dirección:</label><br>
											    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección"><br>
											     <label for="provincia">Provincia:</label><br>
											    <select  class="form-control" name="provincia" id="provincia" style="width:196px;">
												<?php

													foreach($provincias as $provincia){

															echo "<option value='{$provincia->idProvincia}'>{$provincia->nombre}</option>";
													}

												?>

											    </select><br>
										 		
											    <label for="ciudad">Localidad:</label><br>
											    <select  class="form-control" name="ciudad" id="ciudad" style="width:196px;">
														<?php

													foreach($ciudades as $ciudad){

															echo "<option value='{$ciudad->idCiudad}'>{$ciudad->nombre}</option>";
													}

												?>

											

												</select><br>


											   
											

									</div>
												
								<div class="form-group col-lg-5 col-lg-offset-1">
												<label for="entidad">Camara:</label>
			
											     <select  class="form-control"  id="entidad" name="entidad" style="width:196px;">
											     	<option value='0'>Ninguna</option>
											      <?php foreach($entidades as $entidad){

															echo "<option value='{$entidad->idEntidad}'>{$entidad->nombre}</option>";
													  }

												  ?>
												</select>
												<input id="estado" type="checkbox" name="estado" value="1" checked="checked" onclick="changestado()">Activo<br>
												<br>
												


											    <label for="sitioWeb">Sitio Web:</label><br>
											    <input type="text" class="form-control" name="sitioWeb" id="sitioWeb" placeholder="wwww.dominio.com"><br>
											


											
											    <label for="telefono">Telefono:</label><br>
											    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"><br>

											 	
											    
									</div>
						
						</div><br></br><!--end rows-->

  									<div class="row">

											<div class="col-lg-3">
													    <label for="rubro">Rubro:</label><br>

													    <!--begin rubro-->
													    <select  class="form-control"  id="origen" multiple="multiple" style="width:196px;">
																<?php

															foreach($rubros as $rubro){

																	echo "<option value='{$rubro->idRubro}'>{$rubro->nombre}</option>";
															}

														?>

													

														</select>
												</div>
												<div class="col-lg-4 col-lg-offset-1" style="margin-top:40px;width:190px !important">
													<input type="button" class="pasar izq btn btn-danger" value="Pasar »"><input type="button" class="quitar der btn btn-danger" value="« Quitar"><br />
													<input type="button" class="pasartodos izq btn btn-danger" value="Todos »"><input type="button" class="quitartodos der btn btn-danger" value="« Todos">
												</div>

											<div class="col-lg-4" style="margin-top:25px">   
												<select name="rubro[]" id="rubro" multiple="multiple" style="width:197px;height:85px"></select>
											</div>
											  
											  <!--end rubro-->





											 
										


									

								</div><br><!--end rows-->

							
                                




															
				 <!-- begin mapa -->
				    
				<!-- end  mapa -->

						
					 <div clas="form-group">
									
								 <span style="font-weight:bold">Marque Ubicación</span><br>
				                  <div  id="mapa"   style="width:632px;height:300px;"></div><br>
				                  <input id="pac-input" class="controls col-lg-6 col-lg-offset-1" type="text" placeholder="Buscar" style="color:black"/>


									<label for="entidad">Fotos Principal:</label><br>
									 <input class="btn btn-default" name="fotos[]" style="display:inline" type="file" />
												<div class="alert alert-success">
													 <span>Tamaño De Foto Recomendada 134X134 con relación de tamaño 1:1</span>
															           
												</div>
									 <br></br>



                                    
									<label for="entidad">Agregar Foto para slider:</label><br>
									 <input class="btn btn-default" name="fotosSlider[]" style="display:inline" type="file" multiple/><br>
									 <div class="alert alert-success">
															
															 <span>Tamaño De Foto Recomendada 278x157 con relación de tamaño 16:9</span>
															           
															       
												</div>



							
							<button type="submit" class="btn btn-danger" style="width:632px;" >Registrar</button>

					</div>



												
												
											

												

											  
											 
						</form>
				
		
		</div>
</div>
 <!--end form --->		






<!--script-->


@endsection


@section('script')


<script src="{{URL::asset('js/googleMaps.js')}}"></script>
<script src="{{URL::asset('js/validaNegocioForm.js')}}"></script>
<script src="{{URL::asset('js/adminAjaxCiudad.js')}}"></script>
<script src="{{URL::asset('js/negocioViewStore.js')}}"></script>


@endsection