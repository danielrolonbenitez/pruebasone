@extends('app')

@section('content')


<div class="row">

			<div class="from-group col-lg-4 col-lg-offset-4" style="background:rgba(0,0,0,0.5);padding:50px;color:white">
				 <!--Mensaje-->
				@if (Session::has('flash_message'))
	   			 <div class="alert alert-info">{{ Session::get('flash_message') }}</div>
				@endif
				<!--Mensaje-->
				

				 <form role="form" action="{{ route('UserEditStore') }}" method="post">
				  <div class="form-group">
				 	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				 	<input type="hidden" name="id" value="{{ $datos[0]->id }}" />
				 	<label for="nombre">NOMBRE</label><br>
				 	<input class="form-control" type="text" name="nombre" placeholder="Nombre Usuario" title="Ingrese Nombre" value="{{$datos[0]->nombre}}" required/><br>
					<label for="Email">Email</label><br>
				 	<input class="form-control" type="email" name="email" placeholder="Email Usuario" title="Ingrese Email" value="{{$datos[0]->email}}" required/><br>
				 	<label for="Password">Password</label><br>
				 	<input class="form-control" type="password" name="pass"  title="Ingrese Password"  placeholder="********" /><br>
				 	<input type="submit" class="btn btn-default" size="300" value="CREAR">
				</div>
				   


				 </form>
			</div>
			
</div>


 @endsection