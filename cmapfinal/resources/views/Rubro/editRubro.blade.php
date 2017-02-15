@extends('app')
@push('css')
<link rel="stylesheet" href="{{URL::asset('css/colorpicker.css')}}">
@endpush
@section('content')


<div class="row">

			<div class="from-group col-lg-4 col-lg-offset-4" style="background:rgba(0,0,0,0.5);padding:50px;color:white">
				 <!--Mensaje-->
				@if (Session::has('flash_message'))
	   			 <div class="alert alert-info">{{ Session::get('flash_message') }}</div>
				@endif
				<!--Mensaje-->
				

				 <form action="{{ route('rubroEditStore') }}" method="post">
				 	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				 	<input type="hidden" id="color" name="color" value='' />
				 	<label for="nombre">NOMBRE</label><br>
				 	<input type="hidden" value="<?php echo $datos[0]->idRubro; ?>" name="idRubro" >
				 	<input type="text" class="form-control" value="<?php echo $datos[0]->nombre; ?>" title="Ingrese Nombre Rubro" name="nombre" required/><br>
					<label for="colorSelector">Click Para Seleccionar Color:&nbsp</label>
					<div id="colorSelector" style="width:50px;display:inline-block;"><div id="setColor" style="background-color:{{$datos[0]->color}};">&nbsp<i class="glyphicon glyphicon-pencil"></i></div></div><br>
				 	<input type="submit" class="btn btn-default" value="ACEPTAR">

				   


				 </form>
			</div>

</div>

 @endsection
 @push('script-footer')
<script src="{{URL::asset('js/colorpicker.js')}}"></script>
<script>

$('form').on('submit',function(){
 var color="#"+$("div.colorpicker_hex").find('input').val();
 $('#color').attr('value',color);

});



$('#colorSelector').ColorPicker({
	color: '#0000ff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#colorSelector div').css('backgroundColor', '#' + hex);
	}
});
</script>

@endpush
