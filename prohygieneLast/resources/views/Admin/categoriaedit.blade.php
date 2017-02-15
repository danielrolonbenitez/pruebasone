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
			
<!--Mensaje-->











<div class="row">
         
         <div class="col-lg-offset-4 col-lg-12"><h3> EDITAR CATEGORIA</h3></div>

       <div class="col-lg-offset-2 col-lg-6">

          <form action="{{route('categoriaEdit')}}" method="post">
          	   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $categoria[0]->id}}" />
               
               <label for="nombre">ID Categoria</label>
               <input type="text" class="form-control" name="idCat" value="{{$categoria[0]->idCat}}"/><br>

                <label for="">Nombre</label>
               <input type="text" class="form-control" name="pinName" value="{{$categoria[0]->pinName}}"/><br>

               <label for="">ID Grupo</label>
               <input type="text" class="form-control" name="grupo_id" value="{{$categoria[0]->grupo_id}}"/><br>
              
               <label for="">Puede Inscribir</label>
               <input type="text" class="form-control" name="puede_inscribir" value="{{$categoria[0]->puede_inscribir}}"/><br> 

               <input type="submit" value="ACEPTAR" class="btn btn-primary">





          </form>

      </div>

</div>




@endsection