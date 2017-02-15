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
         
         <div class="col-lg-offset-4 col-lg-12"><h3>EDITAR PERIODO</h3></div>

       <div class="col-lg-offset-2 col-lg-6">

          <form action="{{route('periodoEdit')}}" method="post">
          	   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <input type="hidden" name="id" value="{{$periodo[0]->idPeriodo}}" />
               
               <label for="nombre">Nombre Periodo</label>
               <input type="text" class="form-control" name="nombrePeriodo" placeholder="ejemplo Periodo 1" value="{{$periodo[0]->periodoNombre}}"><br>

                <label for="">Destinado</label>
                <select  class="form-control"  name="destinado" >
                @foreach($destinatarios as $destinatario)
                    <option value="{{$destinatario->nombre}}" <?php echo $des=($periodo[0]->destinado==$destinatario->nombre)?"selected='selected'":" "?>>{{$destinatario->nombre}}</option>
                @endforeach
               </select><br>

              
               <label for="">cursos</label>
               <select  class="form-control"  name="curso" >
                @foreach($cursos as $curso)
               	<option value="{{$curso->idCurso}}" <?php echo $resultado=($curso->idCurso==$periodo[0]->idCursoF)? "selected='selected'":" "; ?>>{{$curso->nombre}}&nbsp;&nbsp;{{ $subtitulo=($curso->desCorto)? "(".$curso->desCorto.")" : " " }}</option>
                @endforeach
               </select><br>	
              
                <label for="">Capacitador</label>
               <select  class="form-control"  name="capacitador" >
                @foreach($capacitadores as $capacitador)
                    <option value="{{$capacitador->nombre}}" <?php echo $cap=($periodo[0]->capacitador==$capacitador->nombre)?"selected='selected'":" "?>>{{$capacitador->nombre}}</option>
                @endforeach
               </select><br>

               <label for="">Fecha</label>
               <input type="date" class="form-control"  name="fecha" placeholder="fecha en la que se  dicta el curso" value="{{$periodo[0]->fecha}}"><br>

     

               <input type="submit" value="ACEPTAR" class="btn btn-primary">





          </form>

      </div>

</div>




@endsection