$(function() {
	if($("#login-form")[0]) $("#login-form")[0].reset();
	
	$("#login-form input").focus(function() {
		var me = $(this);
		$("label[for=\"" + me.attr("id") + "\"]").fadeOut("fast");
	});
	$("#login-form input").blur(function() {
		var me = $(this);
		if(me.val().length == 0) {
			window.lelele = $("label[for=\"" + me.attr("id") + "\"]");
			$("label[for=\"" + me.attr("id") + "\"]").fadeIn("fast");
		}
	});
	
	
	
	$("ul.catalog li a").click(function(e) {
		if($(this).parent().find("ul").length > 0) {
			e.preventDefault();
			$(this).parent().siblings().removeClass("selected");//.clearQueue().css("display", "block").slideUp();

			if($(this).parent().is(".selected")) {
				$(this).parent().removeClass("selected");
				$(this).parent().find(" > ul").clearQueue().css("display", "block").slideUp();
			}
			else {
				$(this).parent().addClass("selected");
				$(this).parent().find(" > ul").clearQueue().hide().slideDown();
			}
		}
	});
	
	
	var sending_ns = false;
	$("#newsletter-form").submit(function(e) {
		e.preventDefault();
		if(!sending_ns) {
			sending_ns = true;
			$("*").css("cursor", "wait");
			
			$("#newsletter-form").ajaxSubmit({
				"dataType": "json",
				"success": function(e) {
					sending_ns = false;
					$("*").css("cursor", "");
					
					if(e.status == "ok") {
						alert("Gracias por suscribirse a nuestro newsletter.");
						$("#newsletter-form")[0].reset();
					}
					else if(e.status == "error") alert(e.message);
					else alert("Ocurrió un error desconocido. Por favor, intente de nuevo más adelante.");
				},
				"error": function() {
					sending_ns = false;
					$("*").css("cursor", "");
					alert("Ocurrió un error desconocido. Por favor, intente de nuevo más adelante.");
				}
			});
		}
	});
});
