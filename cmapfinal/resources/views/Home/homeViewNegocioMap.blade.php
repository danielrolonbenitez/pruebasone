@extends('templateHome')

@section('css')
<link rel="stylesheet" href="{{URL::asset('css/homeViewNegocioMap.blade.css')}}" />
<link rel="stylesheet" href="{{URL::asset('css/jquery-ui.css')}}"> 
@endsection

@push('script-header')
<script src="{{ URL::asset('js/jquery.cycle2.js')}}"></script>
<script src="{{ URL::asset('js/jquery.cycle2.carousel.min.js')}}"></script>
@endpush


@section('content')



<!--mensaje-->
  @if (Session::has('flash_message'))
    <div class="alert alert-info" style="position:absolute;top:18%;left:30%">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ Session::get('flash_message') }}
  </div>
  @endif
<!--end mesanje-->

  <div class="position-r"><!--containt form and map-->
    <div class="row">
      <div  id="mapa"   class="col-lg-12" ></div>
    </div><br>

  <!--begin form map-->


    <div class="containtForm">
      <form  id="formShearch" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        <select class="setInput provincias syn shadow"   name="provincia" id="provincias">
          <option value="0" selected="<?php if($provinciasC==0){echo 'value="0"';}?>">Todas Las Provincias</option>
          <?php foreach($provinciaL as $provincia){?>
          <option value="{{$provincia->idProvincia}}" <?php if($provincia->idProvincia==$provinciasC){echo "SELECTED=SELECTED";}?> >{{$provincia->nombre}}</option>
          <?php }?>
        </select>
        <select  class="setInput ciudad margin-izq shadow"  name="ciudad"  id="ciudad">
          <option value="0">Todas Las Ciudades</option>
          <?php foreach($ciudadL as $ciudad){?>
          <option value="{{$ciudad->idCiudad}}" <?php if($ciudad->idCiudad==$ciudadesC){echo "SELECTED=SELECTED";}?> >{{$ciudad->nombre}}</option>
          <?php }?>
        </select>
        <select class="setInput rubro margin-izq shadow" name="rubro" id="rubro">
          <option value="0">Rubros</option>
          <?php foreach($rubroL as $rubro){?>
          <option value="{{$rubro->idRubro}}" <?php if($rubro->idRubro==$rubrosC){echo "SELECTED=SELECTED";}?> >{{$rubro->nombre}}</option>
          <?php }?>
        </select>
        <input class="setInput margin-izq shadow camara" type="text" id="camara" name="camara" value="<?php if(isset($camara)){echo $camara;}?>" placeholder="Camara"/>
        <input class="setInput margin-izq shadow"  type="text" id="clave" name="clave" value="<?php if(isset($clave)){echo $clave;}?>" placeholder="Palabra Clave"/>
      </form>
      <button id="se"  class="btn btn-danger margin-izq shadow" value="Buscar"  onclick="eliminar();markeAjax($('#provincias').val(),$('#ciudad').val(),$('#rubro').val(),$('#camara').val(),$('#clave').val());ajaxloadFotos();">Buscar</button>
    </div>
  <!--end form map-->
  </div><!--containt form and map end-->

<!--begin carusel-->
  <div id="content-carrousel"></div><br>
  <!--dotos del negocio-->
  <div class="row">
    <div class="col-lg-6 col-lg-offset-1" id="grilla" > </div>
    <div class="col-lg-4 position-r">
    <form  class="formStyle">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <select class="setInput2 provincias syn "  name="provincia" id="provincias2">
        <option value="0" selected="<?php if($provinciasC==0){echo 'value="0"';}?>">Todas Las Provincias</option>
        <?php foreach($provinciaL as $provincia){?>
        <option value="{{$provincia->idProvincia}}" <?php if($provincia->idProvincia==$provinciasC){echo "SELECTED=SELECTED";}?> >{{$provincia->nombre}}</option>
        <?php } ?>
      </select><br>
      <select  class="setInput2 ciudad "  name="ciudad" id="ciudad2">
        <option value="0">Todas Las Ciudades</option>
        <?php foreach($ciudadL as $ciudad){?>
        <option value="{{$ciudad->idCiudad}}" <?php if($ciudad->idCiudad==$ciudadesC){echo "SELECTED=SELECTED";}?> >{{$ciudad->nombre}}</option>
        <?php }?>
      </select><br>
      <select class="setInput2 "  name="rubro" id="rubro2">
        <option value="0">Rubros</option>
        <?php foreach($rubroL as $rubro){?>
        <option value="{{$rubro->idRubro}}" <?php if($rubro->idRubro==$rubrosC){echo "SELECTED=SELECTED";}?> >{{$rubro->nombre}}</option>
        <?php } ?>
      </select><br>
      <input class="setInput2 camara"  type="text" id="camara2" name="camara" value="<?php if(isset($camara)){echo $camara;}?>" placeholder="Camara"/></br>
      <input class="setInput2 " type="text" id="clave2" name="clave" value="<?php if(isset($clave)){echo $clave;}?>" placeholder="Palabra Clave"/></br>
    </form>
    <button class="btn btn-danger btn-search shadow" value="Buscar"  onclick="eliminar();markeAjax($('#provincias2').val(),$('#ciudad2').val(),$('#rubro2').val(),$('#camara2').val(),$('#clave2').val());sicronInput()">Buscar</button>
    </div>
  </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">No se encontraron registros</h4>
      </div>
      <div class="modal-body" style="text-align:center">
        <p><h6>Estimado usuario no registramos negocios para&nbsp;<span id="c"></span></h6></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div><br></br>

<!-- end  Modal -->


@endsection

@push('script-footer')

<!--carga los negocios por ajax-->
<script src="{{ URL::asset('js/loadCityForAjax.js')}}"></script>
<script src="{{URL::asset('js/homeViewNegocioMap.blade.js')}}" type="text/javascript"></script>
<!--cargA CIUDADES Al seleccionar otra provincia-->
@endpush