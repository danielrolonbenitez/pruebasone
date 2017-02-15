var pridat;
var map;
var marker = null;
var infowindow = null;
var markers=[];

var lat;
var lng;

function initialize() {




//end caja de texto//









 var locc = new google.maps.LatLng(-34.5844583,-58.4230539,1748);

 var mapOptions = {
    zoom: 14,
    center: locc,
    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }

map = new google.maps.Map(document.getElementById('mapa'), mapOptions);


//agrega la la caja de texto 
// Create the search box and link it to the UI element.
var input = document.getElementById('pac-input');
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);



searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location


      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
    //console.log(markers[0].position.lat());
    //obtenog la latitud y longitud del mark;

   lat=markers[0].position.lat();
   lng=markers[0].position.lng();
    getPosition(lat , lng);

  });


//end caja de texto//





 //cofigo mark click event ;

var contentwindow = '<div>your point</div>'
infowindow = new google.maps.InfoWindow({
    content: contentwindow
 });

google.maps.event.addListener(map, 'rightclick', function(event) {
placeMarker(event.latLng);
});

}

function placeMarker(location) {


    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });





if (marker) {//la primera ves entra por falso y crea el marker luego entra por verdadero y mueve la posicion. 
  marker.setPosition(location);
  //console.log(marker);
  lat=marker.position.lat();
  lng=marker.position.lng();
  getPosition(lat , lng);

} else {
 marker = new google.maps.Marker({
      position: location,
      map: map,
      title: 'My point',
      draggable: false,
     });
   // IF I REMOVE THIS PART -> IT WORKS, BUT WITHOUT INFOWINDOW
   google.maps.event.addListener(marker, 'click', function(){
       infowindow.open(map, marker);
   }); //console.log("no");


  lat=marker.position.lat();
  lng=marker.position.lng();
  getPosition(lat , lng);

 }


}//end inicialite


 function getPosition(lat , lng){  

  var latitudBox=document.getElementById('latitud').value=lat;
  var longitudBox=document.getElementById('longitud').value=lng;


  }



google.maps.event.addDomListener(window, 'load', initialize);


//console.log(lat);