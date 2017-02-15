@extends('app')

@section('content')


<div class="row">

			<div class="from-group col-lg-4 col-lg-offset-4" style="background:rgba(0,0,0,0.5);padding:50px;color:white">
				 
				<!--Mensaje-->
				@if (Session::has('flash_message'))
	   			 <div class="alert alert-info">{{ Session::get('flash_message') }}</div>
				@endif
				<!--Mensaje-->
				 <form action="{{ route('entidadEditStore') }}" method="post">
				 <div class="form-group">
				 	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				 	<label for="nombre">NOMBRE</label><br>
				 	<input type="hidden" value="<?php echo $datos[0]->idEntidad; ?>" name="idEntidad" >
				 	<input type="text" class="form-control" value="<?php echo $datos[0]->nombre; ?>" name="nombre" title="Ingrese Nombre" required><br>
				 	
				    <label for="nombre">SIGLA</label><br>
					<input type="text" class="form-control" value="<?php echo $datos[0]->sigla; ?>" name="sigla" ><br>
				 	<input type="submit" class="btn btn-default" value="ACEPTAR">
				</div>
				   


				 </form>
			</div>



</div>

 @endsection