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
        @if(count($register)>0)                      
					<table id="grilla" class="table table-striped table-bordered" width="100%">
					
						<tr>
								<td colspan="6" style="background:#0046ab;color:white">Log</td>
						</tr>
							 <tr>
					            <td>ID</td>
							 	<td>id_Terms</td>
							 	<td>name</td>
							 	<td>accion</td>
							 	<td></td>
							 </tr>



					

			            
							  
							  <?php
							  		foreach($register as $log){
					                 
					                 echo "<tr>";

					                 echo"<td>".$log->id."</td>";
					                 echo"<td>".$log->id_terms."</td>";
					                 echo"<td>".$log->name_log."</td>";
					                 echo"<td>".$log->accion."</td>";
					 
					                 echo"<td><a  data-toggle='modal' data-target='#MyModal' data-id='".route('tablelogDelete',$log->id_terms)."' type='button' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>";


					                 echo"</tr>";



							  		}




							  ?>

				</table>
          @endif
			</div>
		</div>			
					<?php echo $register->render(); ?>
<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar este Registro?</h4>
        <a id="aceptar"  class="btn btn-danger"  href="">Aceptar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--end modal-->


@endsection

@push('script-footer')

<script src="{{URL::asset('js/eliminar.js')}}"></script> 
@endpush