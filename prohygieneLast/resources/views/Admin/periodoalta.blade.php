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
         
         <div class="col-lg-offset-4 col-lg-12"><h3>ALTA DE PERIODOS</h3></div>

       <div class="col-lg-offset-2 col-lg-6">

          <form action="{{route('periodoAlta')}}" method="post">
          	   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
               <label for="nombre">Nombre Periodo</label>
               <input type="text" class="form-control" name="nombrePeriodo" placeholder="ejemplo Periodo 1"><br>

                <label for="">Destinado</label>
          
                <select  class="form-control"  name="destinado" >

                @foreach($destinatarios as $destinatario)
                    <option value="{{$destinatario->nombre}}">{{$destinatario->nombre}}</option>
                @endforeach
               </select><br>



              
               <label for="">cursos</label>
               <select  class="form-control"  name="curso" >
                @foreach($cursos as $curso)
               	    <option value="{{$curso->idCurso}}">{{$curso->nombre}}&nbsp;&nbsp;{{ $subtitulo=($curso->desCorto)? "(".$curso->desCorto.")" : " " }}</option>
                @endforeach
               </select><br>	
    
               <label for="">Capacitador</label>
               <select  class="form-control"  name="capacitador" >
                @foreach($capacitadores as $capacitador)
                    <option value="{{$capacitador->nombre}}">{{$capacitador->nombre}}</option>
                @endforeach
               </select><br>

               <label for="">Fecha</label>
               <input type="date" class="form-control"  name="fecha" placeholder="fecha en la que se  dicta el curso"><br>

     

               <input type="submit" value="ACEPTAR" class="btn btn-primary">





          </form>

      </div>

</div>




@endsection