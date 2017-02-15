@extends('app')

@section('content')


<div class="row">

	<div class="col-lg-offset-2 col-lg-8 alert alert-success">	
										<span>Tamaño De Foto Principal Recomendada  139x139 con relación de tamaño 1:1</span><br>
										<span>Tamaño De Foto Slider Recomendada 278x157 con relación de tamaño 16:9</span>

	</div>

	 <div class="col-lg-offset-4">	
				
				



				<?php 
				 $uri=explode('public/',$url[0]->url);
				 //dd($uri);
				?>

				<img src="<?php echo url($uri[1]); ?>" style="width:200px;height:200px" ><br></br>

				<form class='cargarFoto' action='{{ route('editarFotoStoreSlider') }}'   method='post' enctype='multipart/form-data'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="idFoto" value="{{ $idFoto}}" />
				<input type="hidden" name="idNegocio" value="{{$idNegocio}}" />

				<input type="file" name="fotos" id="foto"/><br>
				<a   href="{{route('negocioEdit',$idNegocio)}}" class="btn btn-primary">Regresar</a>
				<input type="submit" class="btn btn-danger" value="Editar" id="editar" style="width:100px" disabled/>

				</form>


		</div>

</div>

<script>
$('#foto').on('change',function(){
	$('#editar').prop("disabled", false);
});
</script>




@endsection