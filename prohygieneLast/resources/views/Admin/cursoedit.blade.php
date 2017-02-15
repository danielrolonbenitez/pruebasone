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
         
         <div class="col-lg-offset-4 col-lg-12"><h3> EDITAR CURSO</h3></div>

       <div class="col-lg-offset-2 col-lg-6">

          <form action="{{route('cursoEdit')}}" method="post">
          	   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{ $curso[0]->idCurso}}" />
               
               <label for="nombre">Nombre</label>
               <input type="text" class="form-control" name="nombre" value="{{$curso[0]->nombre}}"><br>

                <label for="">Subtitulo</label>
               <input type="text" class="form-control" name="desCorto" value="{{$curso[0]->desCorto}}"><br>

               <label for="">Descripcion</label>
               <input type="text" class="form-control" name="descripcion" value="{{$curso[0]->descripcion}}"><br>
              
               <label for="">Tipo</label>
          <select  class="form-control" name="tipo">
                @foreach($tipo as $t)
               	<option value="{{$t}}" <?php echo $valor=($curso[0]->tipo==$t)? "selected='selected'" : ' ';  ?>>{{$t}}</option>
               
               @endforeach
               </select><br>	



               <input type="submit" value="ACEPTAR" class="btn btn-primary">





          </form>

      </div>

</div>




@endsection