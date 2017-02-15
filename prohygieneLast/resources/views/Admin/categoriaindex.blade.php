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
								<td colspan="6" style="background:orange;color:white">CATEGORIAS TABLA VNS_WP_PINS

										<span class="pull-right"><a  href="{{ route('categoriaAlta')}}" class="btn btn-primary" >Alta Categoria</a></span>

									</td>
						</tr>
							 <tr>
					             <td>ID</td>
							 	<td>ID categoria</td>
							 	<td>Nombre</td>
							 	<td>ID Grupo</td>
							 	<td>Opciones</td>
						
							 	
							 </tr>



					

			
							  
							  <?php
							  		foreach($categoria as $catego){
					                 
					                 echo "<tr>";

					                 echo"<td>".$catego->id."</td>";
					                 echo"<td>".$catego->idCat."</td>";
					                  echo"<td>".$catego->pinName."</td>";
					                   echo"<td>".$catego->grupo_id."</td>";
					                 
					                 
					                 echo"<td><a href='".route('categoriaEdit',$catego->id)."' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-pencil'></i></a>";
					                 echo"<a  data-toggle='modal' data-target='#MyModal' data-id='".route('categoriaDelete',$catego->id)."' type='button' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>";


					                 echo"</tr>";



							  		}




							  ?>

				</table>

			</div>
		</div>			
					<?php echo $categoria->render(); ?>
<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar esta Categoria?</h4>
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