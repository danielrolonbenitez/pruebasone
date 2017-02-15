@extends('plantilla')

@push('css')
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css')}}">
<link rel="stylesheet" href="{{ asset('css/calendario.css')}}">
@endpush


@section('content')




<div class="row" >
   
      <div class="col-lg-offset-4 col-lg-4" style="background-color:#04428D;padding:10px;position:relative;padding-left:20px;">
        <div style="color:white;font-size:25px;margin-left:30%">Calendario de Capacitación </div><br>
             <span> <a class="" style="color:white;position:absolute;top:20px;left:700px" href="{{route('inscripcion')}}">INSCRIPCIÓN</a></span>
       </div>


</div><br><!--end row-->









     
		<div class="row">

			 	<div id='calendar' class="col-lg-offset-4 col-lg-4"></div>
        

		</div>
	         





<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div style="text-align:center;font-size:18px;font-weight:bold"><span class="modal-periodoNombre"></span>&nbsp&nbsp<span class="modal-fecha"></p></span></div><br>
        <p class="modal-destinadoA"></p>
        <p class="modal-cursoNombre"></p> 
        <p class="modal-desCurso"></p>
        <p class="modal-capacitador"></p>
        
        
        
      </div>
      <div class="modal-body">
        <p class="modal-descripcion"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
@endsection

<!--begin script-->

@push('script')

<script src="{{ URL::asset('js/moment.min.js')}}"></script>
<script src="{{ URL::asset('js/fullcalendar.min.js')}}"></script>
<script src="{{ URL::asset('js/es.js')}}"></script>
<!--script envia por ajax el valor que tiene la caja -->
<script src="{{ URL::asset('js/calendario.js')}}"></script>
@endpush
