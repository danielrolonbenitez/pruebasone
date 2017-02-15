@extends('app')

@section('content')


<div class="row">

	 <div class="col-lg-offset-4">	
			

				<form class='cargarFoto' action='{{ route('addMorePicStore') }}'   method='post' enctype='multipart/form-data'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="idNegocio" value="{{$idNegocio}}" />
				<input type="file" name="fotos[]" id="foto" multiple/><br>
				<button class="btn bntdefault"  onclick="history.back()">Regresar</button>
				<input type="submit" class="btn btn-danger" value="Agregar" id="editar" style="width:100px" disabled/>

				</form>


		</div>

</div>

<script>
$('#foto').on('change',function(){
	$('#editar').prop("disabled", false);
});
//onclick="history.back()"
</script>




@endsection