var app = {
	map: {},
	markers: [],
	lastinfoWindowOpened:false,
	endPointURL: 'http://app.came.org.ar/maparse/mapa/servicio.php',
	imagesURL: 'http://app.came.org.ar/maparse/imagenes/',
	strictBounds: {},
	initialize: function(){
		var geocoder = new google.maps.Geocoder();
var sw = new google.maps.LatLng(-54.952386,-73.081055);
var ne = new google.maps.LatLng(-22.105999,-53.613281);
	
		app.strictBounds = new google.maps.LatLngBounds(sw, ne);
	      var mapOptions = {

          center: new google.maps.LatLng(-38.8219753, -58.1134214),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        app.map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
        app.map.setOptions({minZoom:4});
      
         google.maps.event.addListener(app.map, 'dragend', function() {
                if (app.strictBounds.contains(app.map.getCenter())) return;

                // We're out of bounds - Move the map back within the bounds
                var c = app.map.getCenter(),
                x = c.lng(),
                y = c.lat(),
                maxX = app.strictBounds.getNorthEast().lng(),
                maxY = app.strictBounds.getNorthEast().lat(),
                minX = app.strictBounds.getSouthWest().lng(),
                minY = app.strictBounds.getSouthWest().lat();

                if (x < minX) x = minX;
                if (x > maxX) x = maxX;
                if (y < minY) y = minY;
                if (y > maxY) y = maxY;

                app.map.setCenter(new google.maps.LatLng(y, x));
            });
        
      },
	loadMarkers: function(){
		$.post(app.endPointURL,{op:'traerMarkers'},function(data){
			var data=JSON.parse(data);
			var objAcciones =data.datos;
			app.ubicarMarkers(objAcciones);

		})
	},
	loadMarkersByTheme:function(theme){
		$.post(app.endPointURL,{op:'traerMarkers',theme:theme},function(data){
			var data=JSON.parse(data);
			var objAcciones =data.datos;
			app.ubicarMarkers(objAcciones);
		})
	},
	loadMarkersByDistrict:function(district){
			$.post(app.endPointURL,{op:'traerMarkers',district:district},function(data){
			var data=JSON.parse(data);
			var objAcciones =data.datos;
			var objReferentes=data.referentes;
			//console.log(data);
			app.ubicarMarkers(objAcciones,true);
			addGrilla(objReferentes);




		})
	},
	ubicarMarkers:function(markers,district){
		if(!district){
			district = false;
		}
		if(app.markers.length > 0){
			app.limpiarMarkers();
		}
			$.each(markers,function(i,item){

				    var myLatLng = new google.maps.LatLng(item.lat, item.lng);
				    var marker = new google.maps.Marker({
				        position: myLatLng,
				        map: app.map,
				        icon:item.icono,
				        title: item.texto
		    });
				    if(district){
				    	app.map.setCenter(myLatLng);
				    	app.map.setZoom(10);
				    }
				    else {
				    	app.map.setZoom(4);
				    	//app.map.setCenter(new google.maps.LatLng(-43.556510, -69.082031));
						app.map.setCenter(new google.maps.LatLng(-38.8219753, -58.1134214));
				    }
			var imgString = '';
			$.each(item.imagenes,function(j,imagen){
				imgString = '<div class="imgList">';
				if(imagen.image != ''){
				imgString += '<img src="'+app.imagesURL+'thumbs/'+imagen.image+'" class="thumb"/>';
				}
				imgString += '</div>';
			})
			  	var contentString = '<div id="content_'+item.id+'" class="infobox theme_'+item.theme_id+'">'+
							      '<h1 class="firstHeading">'+item.tema+'</h1>'+
									imgString+
							      '<div id="bodyContent">'+
							      item.texto.substr(0,100)+'...<br/>'+
							      '<a href="#" onclick=app.getLocationInfo(\"'+item.id+'\")>Ver más</a>'+
							      '</div>'+
							      '<h3 class="camera">'+item.camara+'</h3>'+
							      '</div>';
							    
			  	var infowindow = new google.maps.InfoWindow({
									      content: contentString,
									      maxWidth: 200
				});
				google.maps.event.addListener(marker, 'click', function() {
				    infowindow.open(app.map,marker);
				    if(app.lastInfoWindowOpened){
				    	app.lastInfoWindowOpened.close();
				    }
				    app.lastInfoWindowOpened = infowindow;
				});
				app.markers.push(marker);
			})
	},
	limpiarMarkers:function(){
		for(var i = 0;i<app.markers.length;i++){
			app.markers[i].setMap(null);
		}
		app.markers = [];
	},
	getLocationInfo:function(locationId){
		$.post(app.endPointURL,{op:'getLocationInfo',locationId:locationId},function(data){
			var objData = JSON.parse(data);
			console.log(objData);
			$('#datosAccion').show();
			
			var imgString ='';
			var img;
			$.each(objData.imagenes,function(j,imagen){
				if(imagen.image !=''){
				img='<li><a class="group1" href="'+app.imagesURL+imagen.image+'"><img src="'+app.imagesURL+imagen.image+'" /></a></li>';
               imgString+=img;
               
				
				}
			})
                 console.log(imgString);

  				$('#datosAccion').attr('class','theme_'+objData.theme_id);
				$('#datosAccion h2').text(objData.camara);
				$('#datosAccion h5').text(objData.tema);
				$('#datosAccion ul#gallery').html(imgString);
				$('#datosAccion p').html(objData.texto);
				
			
			if(imgString!=''){ initGallery();  }
			else{ $('.prev, .next').hide();$('.caroufredsel_wrapper').hide(); }
		})
	}


}
function initGallery(){

	$('#gallery').carouFredSel({
				width: '90%',
				height: '94px',
				prev: '#prev3',
				next: '#next3',
				auto: false,
				align: 'center'
			});
			
	$(".group1").colorbox({rel:'group1', maxWidth: '60%', maxHeight: '90%'});
}


function addGrilla(objReferentes){

if(objReferentes.length>0){
				$('#grilla').show();
				$('#datosGrilla').children().remove();
				for (var i=0;i<objReferentes.length;i++) {
				 

				$('#datosGrilla').append("<tr><td>"+objReferentes[i].empresa+"</td>"+
										  "<td>"+objReferentes[i].nombre+"</td>"+
										  "<td>"+objReferentes[i].apellido+"</td>"+
										  "<td>"+objReferentes[i].email+"</td></tr>");
					}
			}else{$('#grilla').hide();}


}