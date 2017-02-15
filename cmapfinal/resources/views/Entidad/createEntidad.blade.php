@extends('app')

@section('content')


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



			<div class="from-group col-lg-4 col-lg-offset-4" style="background:rgba(0,0,0,0.5);padding:50px;color:white">
				
				 <form role="form" action="{{ route('storeEntidad') }}" method="post">
				  <div class="form-group">
				 	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				 	<label for="nombre">NOMBRE</label><br>
				 	<input class="form-control" type="text" name="nombre" placeholder="Nombre Entidad" title="Ingrese Nombre" required/><br>
					<label for="nombre">SIGLA</label><br>
				 	<input class="form-control" type="text" name="sigla" placeholder="Sigla Entidad" title="Ingrese Sigla" /><br>
				 	<input type="submit" class="btn btn-default" size="300" value="CREAR">
				</div>
				   


				 </form>
			</div>
			
</div>

 @endsection