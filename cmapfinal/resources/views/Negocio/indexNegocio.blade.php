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
							<tr style="background:silver;color:white">
								<td colspan="2">NEGOCIOS</td>
								<td>
									<a  href="{{ route('negocioViewStore')}}" class="btn btn-success">Agregar Negocio</a>
									<a  href="{{ route('plantillaExcelDownload',3)}}" class="btn btn-danger"><i class="glyphicon glyphicon-save"></i>Descargar Excel</a></td>

								</td>

							</tr>
						
							 <tr>
					            <td>ID</td>
							 	<td>NOMBRE</td>
							 
							 	<td>OPCIONES</td>
							 	
							 </tr>



						</thead>

						<tbody>
							  
							  <?php
							  		foreach($negocios as $negocio){
					                 
					                 echo "<tr>";

					                 echo"<td>".$negocio->idNegocio."</td>";
					                 echo"<td>".$negocio->razonSocial."</td>";
					                 
					                 

					                 echo"<td><a href='".route('negocioEdit',$negocio->idNegocio)."' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-pencil'></i></a>";
					                 echo"<a  data-toggle='modal' data-target='#MyModal' data-id='".route('negocioDelete',$negocio->idNegocio)."' class='eliminar btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a></td>";


					                 echo"</tr>";



							  		}




							  ?>

					      




						</tbody>




					</table>

		<?php echo $negocios->render(); ?>



<!--begin modal-->
<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="biinmo_blue_font">¿Desea Eliminar este negocio?</h4>
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