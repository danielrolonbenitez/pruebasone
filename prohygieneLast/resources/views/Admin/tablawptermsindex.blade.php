@extends('app')
@section('content')
				   <!--mensaje-->

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



													@if (Session::has('flash_message'))
						   			 <div class="alert alert-info">
						   			 	<button type="button" class="close" data-dismiss="alert">&times;</button>
						   			 	{{ Session::get('flash_message') }}

						   			 </div>
								@endif
					<!--end mesanje-->


			<div class="row">

				<div class="col-lg-12">

					<table class="table table-striped table-bordered" width="100%">
						<tr>
						    <td colspan="6" style="background:orange;color:white">TABLA WP_TERMS</td>
						</tr>
							 <tr>
					            <td>ID</td>
							 	<td>NOMBRE</td>
							 	<td>Slug</td>
							 	
							 </tr>

	
							  <?php
							  		foreach($wpterms as $wp){
					                 
					                 echo "<tr>";
					                 echo"<td>".$wp->term_id."</td>";
					                 echo"<td>".$wp->name."</td>";
					                 echo"<td>".$wp->slug."</td>";
					          		 echo"</tr>";  } ?>
					   </table>
				</div>
		</div>		
					<?php echo $wpterms->render();?>
   


    @if($data!=false)
         
			<div class="row">

				<div class="col-lg-12">
              
					<table class="table table-striped table-bordered" width="100%">
						<tr>
						    <td colspan="6" style="background:orange;color:white">insertado o actualizado de WP_TERMS</td>
						</tr>
							 <tr>
							 	<td>ID</td>
					            <td>ID terms</td>
						 		<td>name</td>
						 		<td>slug</td>
						 		<td>accion</td>
						 		<td>opcion</td>
							 </tr>

			
        @foreach($data as $key=>$registrosModificados)


                 <tr>
                  	<td>{{$key }}</td>
                  	<td>{{$registrosModificados->term_id}}</td>
                  	<td>{{$registrosModificados->name}}</td>
                  	<td>{{$registrosModificados->slug}}</td>
                  	<td>{{'insert'}}</td>
                  	<td>
                  		<a  data-attr="{{ route('crossTableData',array('id_terms'=>$registrosModificados->term_id,
                  		'name'=>$registrosModificados->name,
                  		'accion'=>'insert'
                  		))}}" title="cross to table vns_wp_pins" type='button' class='btn btn-sm btn-success ins '><i class='glyphicon glyphicon-random'></i></a>
                        <a data-toggle='modal' data-target='#MyModal' data-id="{{route('wplogDelete',['id'=>$registrosModificados->term_id,'name'=>$registrosModificados->name])}}" type='button' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
                	</td>
                 </tr>
            
        @endforeach


       </table>
     </div>
  </div>

<!--end table-->

<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar Este registro?</h4>
        <a id="aceptar"  class="btn btn-danger"  href="">Aceptar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="MyModalup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4  id="grupo_text">¿Desea Combinar Este registro?</h4>
        <a id="aceptar2"  class="btn btn-danger" href=''>Aceptar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="MyModalins" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <h4  id="grupo_text">!Elija el Grupo para Insertar registro!</h4>
         <form id="formins" action="" method='get'>
         	<label for="rol">ROL</label>&nbsp;<input type="radio" name="group_id" value="1" checked/><br>
            <label for="pais">PAIS</label>&nbsp;<input type="radio" name="group_id" value="2" /><br>
            <label for="Ciudad">CIUDAD</label>&nbsp;<input  type="radio" name="group_id" value="3" /><br>
			<input type="submit" id="aceptarins"  class="btn btn-danger" value="Aceptar"></input>
         </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



<!--end modal-->
 @endif


@endsection

@push('script-footer')
<script>

    /*abre modal update*/
	$('.up').on('click',function(){
	   	 
	   	  $('#MyModalup').modal();
              var url=$(this).attr('data-attr');
               $('#aceptar2').attr('href',url);
          
	});


   /*abre modal insert y setea el accion en el formulario*/

   $('.ins').on('click',function(){
	   	 
	   	  $('#MyModalins').modal();
              var url=$(this).attr('data-attr');
              $('#formins').attr('action',url);
      
          
	});





</script>

<script src="{{URL::asset('js/eliminar.js')}}"></script> 
@endpush