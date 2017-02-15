@extends('app')
@push('css')
<link rel="stylesheet" href="{{URL::asset('css/colorpicker.css')}}">
@endpush
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
				 				

				 <form action="{{ route('storeRubro') }}" method="post">
				 	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				 	<input type="hidden" id="color" name="color" value='' />
				 	<label for="nombre">NOMBRE</label><br>
				 	<input type="text" class="form-control" name="nombre" placeholder="Nombre Rubro" title="Ingrese Nombre Rubro" required/><br>
					<label for="colorSelector">Click Para Seleccionar Color:&nbsp</label>
					<div id="colorSelector" style="width:50px;display:inline-block;"><div id="setColor" style="background-color: rgb(51, 255, 0);">&nbsp<i class="glyphicon glyphicon-pencil"></i></div></div><br>
				 	<input type="submit" class="btn btn-default" value="CREAR">



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







