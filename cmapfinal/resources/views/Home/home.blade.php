@extends('templateHome')

@section('css')
<link rel="stylesheet" href="{{URL::asset('css/home.blade.css')}}" />
@endsection
@push('script-header')
<script src="{{ URL::asset('js/jquery.cycle2.js')}}"></script>
<script src="{{ URL::asset('js/jquery.cycle2.carousel.min.js')}}"></script>
@endpush

@section('content')
<div style="position:relative">
  <div class="row">
    <div  id="mapa"   class="col-lg-12 mapa" ></div>
  </div>
  <div class="row">
    <div class="container col-lg-offset-1">
      <div class="box-form">Buscador de Negocios</div>
      @include('includes.buscador_negocios', ['provincias'=>$provincias, 'rubros' =>$rubros])
    </div>
  </div>
  <!--begin grilla list-->
  <div  style="">
    @include('includes.carrousel',$fotosFiltros)
  </div>
</div>
@endsection

@push('script-footer')
<!--script muestra lista por ajax-->
<!--cargA CIUDADES Al seleccionar otra provincia-->
<script src="{{ URL::asset('js/loadCityForAjax.js')}}"></script>
<script src="{{URL::asset('js/home.blade.js')}}"></script>
@endpush