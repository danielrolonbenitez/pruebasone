
$(document).ready(function(){
  
  $(document).on('keydown',function(e) {
      if (e.keyCode == 13) {
          $('#formShearch').submit();
      }
  });

});




//inicializa mapa//

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

google.maps.event.addDomListener(window, 'load', initialize);


$('#clave').on('click',function(){
 $(this).val('');
});



//carga el nombre de la camara en el campo clave//


$('.camara').on('keyup',function(event) {
  $.ajax({ 
    url:   'ajaxCamara',
    type:  'get',
    beforeSend: function () {},
    success:  function (data) {
      $('.camara').autocomplete({source: data});
    }//end succes
  });
});