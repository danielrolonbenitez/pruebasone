<!DOCTYPE html>
<html>
  <head>
    <!-- This stylesheet contains specific styles for displaying the map
         on this page. Replace it with your own styles as described in the
         documentation:
         https://developers.google.com/maps/documentation/javascript/tutorial -->
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAKAhYtwWh1bDZxldsKSRnNfdXyCEyLf4o"></script>
  
  </head>
  <body>
    <div id="map" style="width:600px;height:300px"></div>
 


    <script>
     var mapa= function iniciar() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          scrollwheel: false,
          zoom: 8
        });
      
        console.log(map.center);
        this.position=function(poslat,poslgn){
         map.setCenter({lat:poslat , lng:poslgn});
        
        }

        this.marca=function(lat,lgn,nombre){
          
          var uluru = {lat: lat, lng: lgn};
          var marker = new google.maps.Marker({
          position: uluru,
          map:map
        });
      
          //this.infoW(marker,nombre);
          return marker;
       }


      mapa.prototype.saluda=function(mensaje){
        alert("jose dice:"+mensaje);
      }
           

      this.infoW=function(marker,nombre){
      var contentString='<div>'+nombre+'</div>';

       var infowindow = new google.maps.InfoWindow({
                         content: contentString
                       });

       marker.addListener('click', function() {
        infowindow.open(map, marker);
              });

      }/*end funcion info*/
                  
      
      this.line=function(flightPlanCoordinates){

  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map:map
  });


      }




      }//end principal



/*utiliza los metodos*/


var longitudes={"longitud":[{'lat':-25.363,'lgn':150.044,'nombre':"pepe"},{'lat':-25.363,'lgn':110.044,'nombre':"jose"},{'lat':-25.363,'lgn':120.044,'nombre':"marcelo"},{'lat':-25.363,'lgn':100.044,'nombre':"ana"}]};
//console.log(longitudes.longitud.length);

  var flightPlanCoordinates=[];
   var mapas =new mapa();
   var datos=longitudes.longitud;
     for (var i=0; i<datos.length;i++){
       var m= mapas.marca(datos[i].lat,datos[i].lgn,datos[i].nombre);
       mapas.infoW(m,datos[i].nombre);
       flightPlanCoordinates[i]={lat:datos[i].lat,lng:datos[i].lgn};
       mapas.line();

      }
     
     mapas.position(-25.363,100.044);
     mapas.line(flightPlanCoordinates);
     //console.log(flightPlanCoordinates);
    // mapas.infoW();
  




    </script>
 


  </body>
</html>