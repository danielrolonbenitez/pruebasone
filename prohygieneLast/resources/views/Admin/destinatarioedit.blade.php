@extends('app')

@section('content')




<!--Mensaje -->
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
			
<!--Mensaje-->











<div class="row">
         
         <div class="col-lg-offset-4 col-lg-12"><h3>EDITAR DESTINATARIO</h3></div>

       <div class="col-lg-offset-2 col-lg-6">

          <form action="{{route('destinatarioEdit')}}" method="post">
          	   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <input type="hidden" name="id" value="{{$destinatario[0]->idDestinatario}}" />
               
               <label for="nombre">Nombre Destinatario</label>
               <input type="text" class="form-control" name="nombre"  value="{{$destinatario[0]->nombre}}"><br>
               <input type="submit" value="ACEPTAR" class="btn btn-primary">





          </form>

      </div>

</div>




@endsection