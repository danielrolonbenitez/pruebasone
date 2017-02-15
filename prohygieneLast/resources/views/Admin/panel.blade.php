@extends('app')

@section('content')

<?php $cant=$cantInscripto[0]->cantidad; if($cant>0){ ?>
	   <!--mensaje-->
								@if (Session::has('flash_message'))
						   			 <div class="alert alert-info">
						   			 	<button type="button" class="close" data-dismiss="alert">&times;</button>
						   			 	{{ Session::get('flash_message') }}

						   			 </div>
								@endif
					<!--end mesanje-->




                	
					   	
	<div class="row">
									<!--en class row form-->
			  <div class="contain-form col-lg-offset-2">  	
			                    	<form action="{{ route('plantillaExcel') }}" method="post" class="form-inline" >
										<input type="hidden" name="_token" value="{{ csrf_token() }}" />



			                	   <div class="col-lg-10" style="text-align:center;background:#0046ab;width:">
								      	<label style="color:white"><h3>Seleccione Año y Periodo</h3></label><br>
									</div>
									
 
							<div class="col-lg-3" style="background-color:#A9C4EB;padding:30px">
								       <label for="">Año</label>&nbsp;
								
								        <select name="anio" id="anio" class="form-control">
										  <?php 
										  		foreach ($anio as $y) {
										  			
										  			echo '<option value="'.$y.'">'.$y.'</option>';
										  			

										  		}




								        	?>
								        </select>
									</div>
								


                                       <div class="col-lg-3" style="background-color:#A9C4EB;padding:30px">
									        <label for="">Periodo</label>&nbsp;
											<select name="periodoNombre" id="periodo" class="form-control"></select>
										</div>
										
										<div class="col-lg-2" style="background-color:#A9C4EB;padding:30px">
											<input type="submit" class="btn btn-danger" value="DESCARGAR">
										
										</div>
									</form>
								

							<div class="col-lg-2" style="background-color:#A9C4EB;padding:30px">

								 <button class="ver btn btn-success" style="width:108px;">VER</button>
							</div>

					</div><!--end class container form-->	

         </div><!--en class row form-->
				


						<br>


<!--verifica si existe nombre periodo  si no muestra una mensaje-->
<?php }else{  echo'<div class="alert alert-info">';
				echo'<button type="button" class="close" data-dismiss="alert">&times;</button>';
						   			 	
                echo '<span>NO HAY INSCRIPTOS</span>';
				echo '</div>'; }                          

		 ?>



           <!--begin grilla-->
         	 <div id="grilla"></div>
			<!--end grilla-->





<!--script-->
@push('script-footer')
<script src="{{URL::asset('js/anioPeriodo.js')}}"></script>

<script>
$('.ver').on('click',function(){

var anio=$('#anio').val();
var periodoNombre=$('#periodo').val();


 var parametros = {
               "anio" : anio,
               "periodoNombre":periodoNombre,
                
        };
        $.ajax({
                data:  parametros,
                url:   'ajaxVerPorPantalla',
                type:  'get',
               beforeSend: function () {
                        
                },
                success:  function (response) {

                $('#grilla').find('table').remove();

                $('#grilla').append(response.html);
                 
				}



			

               
        });//en ajax

});//en function




</script>

@endpush










@endsection