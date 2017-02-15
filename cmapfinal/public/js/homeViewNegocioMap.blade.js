$(document).ready(function(){

 var pl      = $("#provincias").val();
 var cl      = $("#ciudad").val();
 var rl      = $("#rubro").val();
 var camaral = $("#camara").val();
 var cvl   = $("#clave").val();

 markeAjax(pl,cl,rl,camaral,cvl);
 ajaxloadFotos();

$(document).on('keydown',function(e) {
    if (e.keyCode == 13) {
        $('#formShearch').submit();
    }
});

});






function markeAjax(provincia,ciudad,rubro,camara,clave){
  var prov=provincia;
  var ciu=ciudad;
  var rub=rubro;
  var camara=camara;
  var clav=clave;

  var parametros = {
         "prov":prov,
         "ciu":ciu,
         "rub":rub,
         "camara":camara,
         "clav":clav,
  };

  $.ajax({
    data:  parametros,
    url:   'ajaxMarkeMap',
    type:  'get',
    beforeSend: function () {
      $('#grilla').append('<div id="cargando" style="color:white;text-align:center;font-size:40px">CARGANDO...........</div>');
    },
    success:  function (data) { 
      $('#cargando').remove();
      //console.log(data);
      if(data.length==0){
      
        initialize();

        //cargo los valores para setear el modal//
        var pM=$('#provincias option:selected').text();
        var cM=$('#ciudad option:selected').text();
        var rM=$('#rubro option:selected').text();
        var clM=$('#clave').val();

        if(cM=="Todas"){cM="Todas Las Ciudades";}  
        if(rM=="Rubros"){rM="Todos Los Rubros";}

        if(clM==""){
          $('#c').html(pM+'-'+cM+'-'+rM);
        }else{
          $('#c').html('Palabra Clave:'+clM);
        }

        $('#myModal').modal('show');
      
      } else {
            
        var ilat=data[0]['latitud'];//inicializa la latitud del mapa 
        var ilng=data[0]['longitud'];//inicializa la longitus del mapa
        
        /*dependiendo de la cantidad de reusultado setea el zoon*/
        var cantidadResultado=data.length;
        var ProvinciaValue=$('#provincias').val();
        var zoom;

        if(cantidadResultado==1){
          zoom=15;
        } else if(ProvinciaValue==0 ) {
          zoom=3;
        } else {
          zoom=6;
        }

        var map = new google.maps.Map(document.getElementById('mapa'), {
          zoom: zoom,
          center: new google.maps.LatLng(ilat,ilng),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: false,
        });
                                                       
        var infowindow = null;//declaro infowindows//
        infowindow = new google.maps.InfoWindow({content: "holding"});
        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        var sitioWeb=[];
        for (i = 0; i < data.length; i++) { 

          //write camara si existe//
          if(data[i]['nombre']!=null){
          var camara='Camara:'+' '+data[i]['nombre'];
          } else { 
            var camara=" ";
          }

          var pinColor =data[i]['color'];
          pinColor=pinColor.substring(1);
          var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2%7C"+pinColor,
          new google.maps.Size(21, 34),
          new google.maps.Point(0,0),
          new google.maps.Point(10, 34));
          var newIcon ={width: 20, height: 34, primaryColor: "#00008a", cornercolor:"#00008a"};
          /*end icon market created*/
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i]['latitud'], data[i]['longitud']),
            icon: pinImage,
            map: map
          });

            /*defino si tiene o no sitioweb*/
         
              if(data[i]['sitioWeb'].length==0){
               sitioWeb[i]="<span style='color:blue;text-decoration:none;font-weight:bold'>NO POSEE</span>";
              }else
              { 
               sitioWeb[i]="<a style='color:blue;text-decoration:underline;font-weight:bold' target='_blank' href='http://"+data[i]['sitioWeb']+"'>SITIO WEB</a>";
              }

            /*end defino si tiene o no sitio web*/

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent("<h2>"+data[i]['razonSocial']+"</h2>"+
              "<p>"+data[i]['ciudad_nombre']+"|"+data[i]['p_nombre']+ ",</p>"+
              "<p>"+data[i]['direccion']+" ,Argentina</p>"+
              "<p>"+camara+"</p>"+
              "<p><a style='color:blue;text-decoration:underline;font-weight:bold' target='_blank' href='http://maps.google.com/maps?q=loc:"+data[i]['latitud']+','+data[i]['longitud']+"'>COMO LLEGAR</a>&nbsp&nbsp"+sitioWeb[i]+"</p>"+
              "<p style='background-color:"+data[i]["color"]+";color:white;padding:5px'>"+data[i]['rubro_nombre']+"</p>");
              infowindow.open(map, marker);
            }
          })(marker, i));
        }

      addBox(data);

    }
    }//end succes ajax
  });

}//end function 



//agrega laS  CAJA POR AJAX//

function addBox(data){
  var j,imgUrl;

for(j=0;j<data.length;j++){

 imgUrl=data[j]['url'].split('public/');
  //console.log(imgUrl);

  //carga las camara //

  if(data[j]['nombre']!=null){
 var camara='Camara:'+' '+data[j]['nombre'];
}else{ var camara=" ";}



//end carga las camaras//
//pregunta si tiene o no sitio web//
if(data[j]['sitioWeb']!==""){


$('#grilla').append('<div  class="row principal" style="border:2px solid #F6F6F6;width:100%;margin-bottom:20px;height:auto;box-sizing:border-box;word-wrap:break-word;">'+
                                       '<div  style="background-color:'+data[j]["color"]+';color:white;padding-left:5px" >'+data[j]["rubro_nombre"]+'</div>'+
                                       '<div style="float:left;"><span  class="" style="background-color:blue;"><img src="'+imgUrl[1]+'" width="139" height="139" alt=""></span></div>'+
                                        '<div  style="background-color:white;float:left;margin-left:10px;box-sizing: border-box;padding-top:5px;word-wrap:break-word;max-width:270px">'+
                                         '<span style="margin-top:2%;font-size:20px;font-weight:bold;">'+data[j]['razonSocial']+'</span><br></br>'+
                                       
                                         '<span style="word-wrap: break-word;">'+data[j]['ciudad_nombre']+"&nbsp|&nbsp"+data[j]['p_nombre']+',</span><br>'+
                                         '<span>'+data[j]['direccion']+',&nbspArgentina.</span><br>'+
                                          '<span>'+camara+'</span>'+
                                         '</div>'+
                                         '<div  style="background-color:white;float:right;border-left:2px solid #F6F6F6;border-bottom:2px solid #F6F6F6;;text-align:center;height:139px;width:150px">'+
                                          '<div style="height:69px;border-bottom:1px solid #F6F6F6;padding-top:20px"><a style="color:blue !important" target="_blank" href="http://maps.google.com/maps?q=loc:'+data[j]['latitud']+","+data[j]['longitud']+'">COMO LLEGAR</a></div>'+
                                          '<div style="padding-top:20px"><a style="color:blue !important" target="_blank" href="http://'+data[j]['sitioWeb']+'">SITIO WEB</a></div></div>'+

                      '</div>');

      
}else{

$('#grilla').append('<div  class="row principal" style="border:2px solid #F6F6F6;width:100%;margin-bottom:20px;height:auto;box-sizing:border-box;word-wrap:break-word;">'+
                                       '<div  style="background-color:'+data[j]["color"]+';color:white;padding-left:5px" >'+data[j]["rubro_nombre"]+'</div>'+
                                       '<div style="float:left;"><span  class="" style="background-color:blue;"><img src="'+imgUrl[1]+'" width="139" height="139" alt=""></span></div>'+
                                        '<div  style="background-color:white;float:left;margin-left:10px;box-sizing: border-box;padding-top:5px;word-wrap:break-word;max-width:270px">'+
                                         '<span style="margin-top:2%;font-size:20px;font-weight:bold">'+data[j]['razonSocial']+'</span><br></br>'+
                                        
                                         '<span style="word-wrap: break-word;">'+data[j]['ciudad_nombre']+"&nbsp|&nbsp"+data[j]['p_nombre']+',</span><br>'+
                                         '<span>'+data[j]['direccion']+',&nbspArgentina.</span><br>'+
                                         '<span>'+camara+'</span>'+
                                         '</div>'+
                                         '<div  style="background-color:white;float:right;border-left:2px solid #F6F6F6;border-bottom:2px solid #F6F6F6;;text-align:center;height:139px;width:150px">'+
                                          '<div style="height:69px;border-bottom:1px solid #F6F6F6;padding-top:20px"><a style="color:blue !important" target="_blank" href="http://maps.google.com/maps?q=loc:'+data[j]['latitud']+","+data[j]['longitud']+'">COMO LLEGAR</a></div>'+
                                          '<div style="padding-top:20px"><span style="color:blue">NO POSEE</span></div>'+

                                        '</div>'+

                      '</div>');



}
      }//end foreach   

 }//end data addBox//







/*begin foto ajax */
function ajaxloadFotos(){
var idRubro=$('#rubro').val();
var idProvincia=$('#provincias').val();
var idCiudad=$('#ciudad').val();

 var parametros={'idRubro':idRubro,'idProvincia':idProvincia,'idCiudad':idCiudad};
  
  $.ajax({
    data: parametros, 
    url:   'ajaxLoadFotos',
    type:  'get',
    beforeSend: function () {
      
    },
    success:  function (data) {
      //console.log("hola");
      //console.log(data);

    $('#content-carrousel').find('.box-carousel').remove();
    $('#content-carrousel').append(data.html);

    }//end succes
  });

}


/* end foto ajax*/
function initialize() {
 var locc = new google.maps.LatLng(-34,-58);
 var mapOptions = {
    zoom: 4,
    center: locc,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
  }
  map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
}

function sicronInput()
{
  
    $('#provincias').val($('#provincias2').val());
   $('#ciudad').val($('#ciudad2').val());
   $('#rubro').val($('#rubro2').val());
   $('#clave').val($('#clave2').val());

}

function eliminar()
{

  $('#grilla').find('.principal').remove();
}

$('.camara').on('keyup',function(event) {

     $.ajax({ 
    url:   'ajaxCamara',
    type:  'get',
    beforeSend: function () {
     
    },
    success:  function (data) {
    
     $('.camara').autocomplete({
       
      source: data
      
     });

    }//end succes
  });

});