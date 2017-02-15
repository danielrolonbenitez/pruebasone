@extends('plantilla')
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/inscripcion.css')}}" />
@endpush
@section('content')



 @if(!empty($puedeInscribir))

<div class="row">

	   <!--mensaje-->
	   
						   			 <div id="content-mensaje" style="display:none" class="alert alert-info">
						   			 	<button type="button" class="close" id="closeModal">&times;</button>
						   			 	
						   			 	<span id="mensaje"></span>
						   			 </div>
								
					<!--end mesanje-->

	
			


	<div class="col-lg-6 col-lg-offset-4">
		
		<div style="margin-top:10px;color:white;text-align:center;background-color:#286BCC;padding:5px 0px 5px 0px;border-radius:5px;position:relative;min-height:90px">
          <div style="font-weight:bold;font-size:20px;">Inscripción a Cursos </div><br>
          <a class="aReset" href="{{route('vercalendario')}}" style="color:white;padding-right:10px;top:53px;left:455px;position:absolute;">Ver Plan</a>
            <!--begin formulario-->
         <form style="position:absolute;left:300px">
				<select name="periodoNombre" id="periodo" style="background:#286BCC"></select>


            <select name="anio" id="anio" style="background:#286BCC">
            	  <?php 
										  		foreach ($anio as $y) {
										  			
										  			echo '<option value="'.$y.'">'.$y.'</option>';
										  			

										  		}




								        	?>
            	

            </select>

          </form>

            <!--end formulario-->


           
		</div>
		<div style="font-weight:bold;margin-top:5px;">Inscripto de:&nbsp{{$userLoginWp[0]->email}}</div><br>
			
		

	</div>

</div>

      
       <div class="row"><!--begin form-->
						
				<div class="col-lg-offset-4" style="box-sizing:border-box">
					<form style="float:left" >
						<input type="hidden" id="periodoNombre" name="periodoNombre" value="{{$periodoNombre}}" />
							
						       
                     
                                    
									<select class="setInput" name="curso" id="curso" style="width:285px;margin-left:15px">
										 <option id="remove">Cursos</option>
										
									</select>
								

								
									<input  type="text" class="setInput" style="margin-left:15px;width:90px"  id="fecha" name="fecha" value="Fecha" readonly></input>
								
								
									<input class="setInput" type="text" style="margin-left:15px;width:200px"  placeholder="Email" name="email" id="email" value="" >

									<input class="setInput" type="text" style="margin-left:15px;width:200px"  placeholder="Skype" name="skype" id="skype" >		
					
							

					</form>
				
					
                <button  class="btn btn-default"  id="agregar"  onclick="guardar()" style="width:100px">AGREGAR</button>
             

            </div>
					

     </div><br><!--end form-->



                 <!--begin table-->
 						
       <div class="row">
						
			<div class="col-lg-6 col-lg-offset-4">	
                  <div style="width:950px;box-sizing:border-box;height:400px;overflow-y:scroll;overflow-x:hidden;">
							<table  style="margin-left:2px;width:900px;" id="grilla"  >
								<thead>
									      <tr style="font-weight:bold;text-decoration:underline;">
										  		<td align="center" class="setborder alto fondo">Curso</td>
										 		<td align="center" class="setborder alto fondo">Fecha</td>
										  		<td align="center"class="setborder alto fondo" >Email</td>
										  		<td align="center" class="setborder alto fondo">Rol</td>
										  		<td align="center" class="setborder alto fondo">Ciudad</td>
										  		<td align="center" class="setborder alto fondo">Pais</td>
										  		<td align="center" class="setborder alto fondo">Skype</td>
										  		<td></td>
												
										  </tr>
	                             </thead>
								    <tbody>		
									<!--carga los usarios ya inscriptos nuevos y ya inscriptos en la grilla-->
								    </tbody>
							</table>
					</div>
			</div>
	 </div>


					<!--end table-->







	 @else
	 	   <div class="alert alert-info"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>No es posible procesar la incscripción. Por favor ingrese nuevamente al sistema y verifique tener permisos para inscribir.</div>
	 @endif
 

@endsection











        <!--begin script-->

@push('script')
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script src="{{ asset('js/curso.js')}}"></script>


@endpush


