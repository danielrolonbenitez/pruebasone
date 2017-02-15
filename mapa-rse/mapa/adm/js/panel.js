// JavaScript Document

$(document).ready(function(){  
  
    $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)  
  
  $("ul.topnav li").click(function(){MenuAbajo($(this).find("span"))});
   
   
 //$("ul.topnav li span").click(function(){MenuAbajo(this)});
   
   
   		$("ul.topnav li span").hover(function() {$(this).addClass("subhover");}, function(){$(this).removeClass("subhover");});  
  
});  
   



function MenuAbajo(a) {
        $(a).parent().find("ul.subnav").slideDown('fast').show();
        $(a).parent().hover(function() {}, function(){$(a).parent().find("ul.subnav").slideUp('slow');})
        };
		
		
		
/* ALTA CAMARA */

function validar_alta_cam()
{
	var nombre=$("#nombre").val();
	var av=$("#nombre").val();
	var direccion=$("#direccion").val();
	var ciudad=$("#ciudad").val();
	var provincia=$("#provincia").val();
	
	var men='';
	if(nombre=='') men+="Debe ingresar un nombre.\n";
	if(av=='') men+="Debe ingresar una Abreviatura.\n";
	if(direccion=='') men+="Debe ingresar la dirección.\n";
	if(ciudad==0) men+="Debe seleccionar una ciudad.\n";
	if(provincia==0) men+="Debe seleccionar una provincia.\n";
	if(men!='')
	{
		alert(men); return false; 
	}
	return true;
	

}



