//evalvar polyShape;var polyLineColor="#FFCC33";var polyFillColor="#FFCC33";var CirculoIcon=new GIcon(G_DEFAULT_ICON);CirculoIcon.iconSize=new GSize(6,6);CirculoIcon.shadow="";CirculoIcon.image="images/provincia_mapa.png";CirculoIcon.iconAnchor=new GPoint(3,3);CirculoIcon.infoWindowAnchor=new GPoint(3,0);var CamIcon=new GIcon(G_DEFAULT_ICON);CamIcon.iconSize=new GSize(4,4);CamIcon.shadow="";CamIcon.image="images/circulo_chico_verde.png";CamIcon.iconAnchor=new GPoint(2,2);CamIcon.infoWindowAnchor=new GPoint(2,0);var FedIcon=new GIcon(G_DEFAULT_ICON);FedIcon.iconSize=new GSize(4,4);FedIcon.shadow="";FedIcon.image="images/circulo_chico_azul.png";FedIcon.iconAnchor=new GPoint(2,2);FedIcon.infoWindowAnchor=new GPoint(2,0);var MIcon=new GIcon(G_DEFAULT_ICON);MIcon.iconSize=new GSize(4,4);MIcon.image="images/circulo_chico_amarillo.png";MIcon.iconAnchor=new GPoint(2,2);MIcon.infoWindowAnchor=new GPoint(2,0);$(document).ready(function(){	initialize('');	switch_listas(1);	redimencionar();	$(window).resize(redimencionar);	$("#provincia, #ciudad").change(function(){		mapCenter()	});	$("#ciudad").next("*:button").click(function(){		mapCenter()	});	/*$("body").append("<img class='mapr' src='images/mapr2.png'>");	$(".mapr").css({		position:"absolute",		top:"0px",		right:0	});*/	var x=$(".otras").next("li:visible").size();	if(x==0)$(".otras").hide();else $(".otras").show();	$("#busc6,#busc66").autocomplete('index.op.php?autocompete=1',{		minChars:3,		matchSubset:false,		matchContains:true,		cacheLength:10,		selectOnly:1,		width:800	}).result(function(a,b,c){		verDatosporData(b)	});	$(".integrantes").on("click",function(){		$("#integrantes").toggle()	});	$("#buscarevento").on("click",function(){		buscarEvento()	});	$("#buscarevento2").on("click",function(){		buscarEventoGral()	});	$.getScript('http://www.central223.com/keycamemap.js');		$('#search-menu-content select').customSelect();});function switch_listas(a){	$("#listado_camaras").hide();	$("#listado_provincias").hide();	$("#buscadortotal").hide();	$("#infototal").hide();	switch(a){		case 1:			$("#listado_provincias").show();			break;		case 2:			$("#listado_camaras").show();			break;		case 3:			$("#buscadortotal").show();			break;		case 4:			$("#infototal").show();			break	}}function abrirBuscadorTotal(){	$("#provincia").val('0');	$("#ciudad").val('0');	mapCenter();	switch_listas(3);	$(".tog").html("<a href='#' onClick='cerrarBuscadorTotal();return false;'>B&uacute;sque <b>C&aacute;maras y Federaciones</b>.</a>")}function cerrarBuscadorTotal(){	$("#provincia").val('0');	$("#ciudad").val('0');	mapCenter();	switch_listas(1);	$(".tog").html("<a href='#' onClick='abrirBuscadorTotal();return false;'>B&uacute;sque <b>Eventos y Actividades</b> en todas las C&aacute;maras y Federaciones.</a>")}function buscarEvento(){	$("#htmleventos").show();	$(".the_evt").remove();	$("#infototal #htmleventos").html("Cargando...");	var a=$("#idcam").val();	var b=$("#idcam").attr("iscam");	var c=$("#pasado:checked").size();	var d=$("#txtevento").val();	var e=$("#categoria").val();	var f="oper=showeventos&iscam="+b+"&id="+a+"&pasado="+c+"&txt="+d+"&cat="+e;	$.get("index.op.php",f,function(x){		mostrarEventos(x);		$("*[rel='facebox']").facebox();		reducir_imagenes()	})}function reducir_imagenes(){	$(".img_th_evento").hide().load(function(){		var x=$(this).width();		var y=$(this).height();		var a=120;		var b=(x>y)?a/x*y:a;		var c=(y>x)?a/y*x:a;		$(".img_th_evento").width(c).height(b).show()	})}function buscarEventoGral(){	$(".htmleventos2").html("Cargando...");	var a=$("#pasado2:checked").size();	var b=$("#txtevento2").val();	var c=$("#categoria2").val();	var d="oper=showeventosGral&pasado="+a+"&txt="+b+"&cat="+c;	$.get("index.op.php",d,function(x){		mostrarEventosGral(x);		$("*[rel='facebox']").facebox();		reducir_imagenes()	})}function verDatosporData(a){	var b=a[1];	if(b>500000)verDatos(b-500000,false);else verDatos(b,true)}function redimencionar(){	/*var x=$(window).height();	$("#mapa").height(x-115);	$("#listado_camaras, #listado_provincias,#infototal,#buscadortotal").height(x-135);	var x=$(window).width();	$("#lista").width(x-760);	$("#listado_camaras, #listado_provincias, #infototal,.tog, #buscadortotal"/*, #buscador_camaras"* /).width(x-735);	$("#listado_provincias li").hover(function(){		$("#listado_camaras li[class!='otras']").css("background","");		$(this).css("background","#ffff99")	},function(){		$(this).css("background","")	});	$("#listado_camaras li[class!='otras']").hover(function(){		$("#listado_camaras li[class!='otras']").css("background","");		$(this).css("background","#ffff99")	},function(){		$(this).css("background","")	});	$("#ciudad").width("165px").css("overflow-x","hidden");	$("#provincia").width("165px").css("overflow-x","hidden")*/}function buscarmarcas(){	switch_listas(2);	map.clearOverlays();	if($("#provincia").val()==0)return;	$.each(marcasJ,function(a,b){		var c=(b.cam_id_provincia>0)?b.cam_id_provincia:b.fed_id_provincia;		var d=(b.cam_id_ciudad>0)?b.cam_id_ciudad:b.fed_id_ciudad;		var e=$("#ciudad").val();		var f=$("#provincia").val();		if(e==0&&f==0)marcar(b,false);		if(f>0&&e==0&&f==c){			marcar(b,false)		}		if(f>0&&e>0&&f==c&&e==d)marcar(b,false)	})}var marCam=new Array();var marFed=new Array();function marcar(a,b){	var x=a.point.split(",");	var c=(a.id_camara)?true:false;	if($("#provincia").val()==0&&c&&b!=true)return;	var d=(c)?"images/circulo_chico_verde.png":"images/circulo_chico_azul.png";	if(x[0]==''||x[1]==''||x[0]==null||x[1]==null)return;	var p=new GLatLng(x[0],x[1]);	markerOptions=(a.id_camara>0)?{		icon:CamIcon	}:{		icon:FedIcon	};		var e=new GMarker(p,markerOptions);	if(c)marCam[a.id_camara]=e;else marFed[a.id_federacion]=e;	map.addOverlay(e);	var f=marcaHtml(a);	GEvent.addListener(e,'click',function(){		verDatos(a.unicId,c)	});	GEvent.addListener(e,'mouseover',function(){		e.openInfoWindowHtml(f,{			maxWidth:120		});		e.setImage("images/circulo_chico_amarillo.png");		liOn(a)	});	GEvent.addListener(e,'mouseout',function(){		e.setImage(d);		liOff(a)	})}function forzarVista(c){	$.each(marcasJ,function(a,b){		if(c==b.unicId){			marcar(b,true);			ubicar_marca(c,b.iscam);			return		}	})}function verDatos(b,c){	switch_listas(4);	$("#infototal .datosh").html("Cargando...");	redimencionar();	var d="oper=showinfo&iscam="+c+"&id="+b;	$.get("index.op.php",d,function(x){		var a="oper=showeventos&iscam="+c+"&id="+b;		mostrarInfo(x);		$("#infototal #htmleventos").html("Cargando...");		$.get("index.op.php",a,function(x){			mostrarEventos(x);			$("*[rel='facebox']").facebox();			reducir_imagenes();			ubicar_marca(b,c)		})	})}function ubicar_marca(a,b){	a=parseInt(a);	if(b){		if(!marCam[a]){			forzarVista(a);			return		}		var c=marCam[a].getLatLng()	}else{		if(!marFed[a]){			forzarVista(a);			return		}		var c=marFed[a].getLatLng()	}	var p=new GLatLng(c.lat(),c.lng());	map.setCenter(p,16)}function mostrarInfo(x){	$("#infototal .datosh").html(x)}function mostrarEventosGral(x){	$(".htmleventos2").html(x);	$("#txtevento2").keypress(function(e){		if(e.which==13)$(this).next("*:button").click()	})}function mostrarEventos(x){	$("#htmleventos").show();	$(".the_evt").remove();	$("#infototal #htmleventos").html(x);	$("#txtevento").keypress(function(e){		if(e.which==13)$(this).next("*:button").click()	})}function markOn(a,b){	if(b){		if(marCam[a])marCam[a].setImage("images/circulo_chico_amarillo.png")	}else{		if(marFed[a])marFed[a].setImage("images/circulo_chico_amarillo.png")	}}function markOff(a,b){	if(b){		if(marCam[a])marCam[a].setImage(CamIcon.image)	}else{		if(marFed[a])marFed[a].setImage(FedIcon.image)	}}function liOn(a){	if(a.id_camara>0)var x=$("li[id_camara="+a.id_camara+"]");else var x=$("li[id_federacion="+a.id_federacion+"]");	$(x).css("background","#ffff99")}function liOff(a){	if(a.id_camara)var x=$("li[id_camara="+a.id_camara+"]");else var x=$("li[id_federacion="+a.id_federacion+"]");	$(x).css("background","")}function marcaHtml(a){	if(a.id_camara>0){		var b=(a.cam_web>''&&a.cam_web!='http://')?"<hr><a href='"+a.cam_web+"' target='_blank'>"+a.cam_web+"</a>":'';		var x="<b>"+a.cam_nombre+"</b>";		if(a.cam_abreviacion>'')x+=" ("+a.cam_abreviacion+")";		x+="<br>"+a.datos+b	}else{		var b=(a.fed_web>''&&a.fed_web!='http://')?"<hr><a href='"+a.fed_web+"' target='_blank'>"+a.fed_web+"</a>":"";		var x="<b>"+a.fed_nombre+"</b>";		if(a.fed_abreviacion>'')x+=" ("+a.fed_abreviacion+")";		x+="<br>"+a.datos+b	}	return x}function restablecerForm(){	$("#provincia option").eq(0).attr("selected","selected");	$("#ciudad option").eq(0).attr("selected","selected");	mapCenter();	switch_listas(1);	$("*[name='busc66']").val('')}function mapCenter(){	listar_camaras();	var a=$("#provincia").val();	var b=$("#provincia").find("*:selected").text();	var c=$("#ciudad").val();	var d=$("#ciudad").find("*:selected").text();	if(a==0){		provinciasOn();		map.setCenter(new GLatLng(-36.817813,-60.808594),4);		return	}	provinciasOff();	if(c==0){		var e=GprovinciaFind(a);		var x=Gprovincias[e].gp;		var f=x.getBounds();		map.setCenter(f.getCenter());		map.setZoom(map.getBoundsZoomLevel(f)+1)	}else{		var g=15;		flyProvincia(b+" , "+d+" , Argentina",g)	}	buscarmarcas()}function listar_camaras(){	var a=$("#provincia").val();	var b=$("#ciudad").val();	$("#listado_camaras li").show();	if(a>0)$("li.federacion[id_provincia!='"+a+"'],  li.camara[id_provincia!='"+a+"']").hide();	if(b>0)$("li.federacion[id_ciudad!='"+b+"'],li.camara[id_ciudad!='"+b+"']").hide();	var x=$(".otras").next("li:visible").size();	if(x==0)$(".otras").hide();else $(".otras").show()}function cambiar_vista(tipo) {	map.setMapType(tipo);	if(tipo == G_SATELLITE_MAP) {		$("#mapa-satelite").addClass("selected");		$("#mapa-normal").removeClass("selected");	}	else {		$("#mapa-satelite").removeClass("selected");		$("#mapa-normal").addClass("selected");	}}