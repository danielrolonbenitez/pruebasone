@extends('app')
@section('content')


			

				      <!--mensaje-->
								@if (Session::has('flash_message'))
						   			 <div class="alert alert-info">
						   			 	<button type="button" class="close" data-dismiss="alert">&times;</button>
						   			 	{{ Session::get('flash_message') }}

						   			 </div>
								@endif
					<!--end mesanje-->

  <table class="table table-striped table-bordered">
                  <thead>
                     <tr style="color:white;background:silver">
                             	<td colspan="3" >USUARIOS</td>
                             	@if(Auth::user()->rol==1)
							 	<td><a style="" href="{{ route('AltaUsuario')}}" class="btn btn-success">Agregar Usuario</a></td>
							 @endif
							 </tr>
							 
							 <tr>
					             <td>ID</td>
							 	<td>NOMBRE</td>
							 	<td>EMAIL</td>
							 	<td>OPCIONES</td>
							 	
							 </tr>
                  </thead>
                  <tbody>
                           <?php
							  		foreach($users as $user){
					                 
					                 echo "<tr>";

					                 echo"<td>".$user->id."</td>";
					                 echo"<td>".$user->nombre."</td>";
					                 echo"<td>".$user->email."</td>";
					                 
					                 if(Auth::user()->rol==1){
					                 echo"<td><a href='".route("UserEdit",$user->id)."' title='Editar Cuenta' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-pencil'></i></a>";
					                 echo"<a  data-toggle='modal' data-target='#MyModal' data-id='".route("UserDelete",$user->id)."' title='Remover Cuenta' type='button' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>";
					             		}else{

					             		echo"<td><a href='#'><i class='glyphicon glyphicon-pencil'></i></a>";
					                	 echo"<a href='#'><i class='glyphicon glyphicon-remove'></i></a></td>";
					             		}	

					                 echo"</tr>";



							  		}




							  ?>


 </tbody>
</table>
<?php echo $users->render(); ?>



	
<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar este usuario?</h4>
        <a id="aceptar"  class="btn btn-danger"  href="">Aceptar</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--end modal-->


@endsection

@section('script')
<script src="{{URL::asset('js/eliminar.js')}}"></script> 
@endsection