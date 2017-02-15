

// Fonts -----
Cufon.replace('.FjO', { fontFamily: 'Fjalla One', hover: true });
// -----------

// Ajustar ancho de ventana ---
function AjustarAncho() {	
	var ancho_minimo=980;
	var ancho=$(window).width();
	if (ancho<ancho_minimo) { 
		ancho=ancho_minimo; 
	}
	$('#slideshow').width(ancho);
}
// -- fin -----


$(document).ready(function() {

	// Menu ----------
	$(".main-navigation ul li, .main-navigation ul li a").hover(function () {
		Cufon.refresh();
	},function () {
		Cufon.refresh();
	}); 
        $('.page-empresa .menu-item2').addClass('activo');
        $('.page-productos .menu-item3').addClass('activo');
        $('.page-novedades .menu-item4').addClass('activo');
        $('.page-contacto .menu-item5').addClass('activo');
        $('#site-navigation ul.nav-menu').droppy({speed: 200});

        // Por si cambian el tama�o de la ventana
        $(window).resize( function () {
                AjustarAncho();
        });
        AjustarAncho();
        // -- fin -----

        
	 // Form -----
        $("#formNews label").css({
                "display": "inline",
                "left": "10px",
                "position": "absolute",
                "top": "8px",
                "z-index": "99"
        });
        $("#formConsulta label").css({
                "display": "inline",
                "left": "30px",
                "position": "absolute",
                "top": "8px",
                "z-index": "99"
        });
        $('#formNews input').focus(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){
                        label.stop().animate({ 'left':'-130px' }, 300);
                } 
        }).blur(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){					
                        label.stop().animate({ 'left':'10px' }, 300);
                }
        });
        $('#formConsulta input, #formConsulta textarea').focus(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){
                        label.stop().animate({ 'left':'-130px' }, 300);
                } 
        }).blur(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){					
                        label.stop().animate({ 'left':'30px' }, 300);
                }
        });
	$("select").uniform();
	// fin Form ---------------
	
	$("#formConsulta2 label").css({
                "display": "inline",
                "left": "30px",
                "position": "absolute",
                "top": "8px",
                "z-index": "99"
        });
	  $("#formConsulta2 div.checkboxes label").removeAttr("style");
	  $('#formConsulta2 input, #formConsulta2 textarea').focus(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){
                        label.stop().animate({ 'left':'-130px' }, 300);
                } 
        }).blur(function(){
                var label = $(this).parent().parent().find('label');
                var value = $(this).val();
                if(value == ''){					
                        label.stop().animate({ 'left':'30px' }, 300);
                }
        });

});


$(window).load(function(){
        $('.main-navigation').css({'overflow':'inherit'});
});

$(function() {	
	var sending = false;
	$("#formConsulta").submit(function(e) {
		e.preventDefault();
		if(!sending) {
			sending = true;
			$("*").css("cursor", "wait");
			$("#formConsulta").ajaxSubmit({
				"dataType": "json",
				"success": function(e) {
					sending = false;
					$("*").css("cursor", "");

					if(e.status == 'error') alert(e.message);
					else {
						$("#formConsulta")[0].reset();
						alert("Gracias por ponerse en contacto con nosotros.");
					}
				},
				"error": function(e) {
					sending = false;
					$("*").css("cursor", "");
					alert("Ocurrió un error desconocido. Por favor inténtelo más tarde.");
				}
			});
		}
	});
});