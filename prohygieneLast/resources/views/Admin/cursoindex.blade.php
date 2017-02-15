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
                                           
					<table id="grilla" class="table table-striped table-bordered" width="100%">
					  <!--begin search-->
					  <tr>
					  	<td colspan="6">
					        
						        <form class="navbar-form" action="{{route('cursoIndex')}}" role="search" method="post">
						        <div class="input-group">
						        	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						            <input type="text" class="form-control" placeholder="Search" name="busqueda" id="busqueda">
						            <div class="input-group-btn">
						                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						            </div>
						        </div>
						        </form>
						      



					  	</td>

					  </tr>
					   <!--end search-->
						<tr>
								<td colspan="6" style="background:#0046ab;color:white">CURSOS
									
										<span class="pull-right"><a  href="{{ route('cursoAlta')}}" class="btn btn-primary" >Agregar Curso</a></span>

									</td>
						</tr>
							 <tr>
					             <td>ID</td>
							 	<td>NOMBRE</td>
							 	<td>Subtitulo</td>
							 	<td>Descripcion</td>
							 	<td>Tipo</td>
							 	<td></td>
							 	
							 </tr>



					

			
							  
							  <?php
							  		foreach($cursos as $curso){
					                 
					                 echo "<tr>";

					                 echo"<td>".$curso->idCurso."</td>";
					                 echo"<td>".$curso->nombre."</td>";
					                  echo"<td>".$curso->desCorto."</td>";
					                   echo"<td>".$curso->descripcion."</td>";
					                    echo"<td>".$curso->tipo."</td>";
					                 
					                 echo"<td><a href='".route('cursoEdit',$curso->idCurso)."' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-pencil'></i></a>";
					                 echo"<a  data-toggle='modal' data-target='#MyModal' data-id='".route('cursoDelete',$curso->idCurso)."' type='button' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>";


					                 echo"</tr>";



							  		}




							  ?>

				</table>

			</div>
		</div>			
					<?php echo $cursos->render(); ?>
<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar este Curso?</h4>
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