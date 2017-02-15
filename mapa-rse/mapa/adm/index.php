<? include_once("init.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_titulopagina_?></title>
<link href="images/panel.css" rel="stylesheet" type="text/css" />
<link href="adm.css" rel="stylesheet" type="text/css" />
<link href="plugins/facebox/facebox.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/panel.js"></script>
<script src="plugins/facebox/facebox.js"></script>
<script>
$(document).ready(function(){
			$("*[rel='facebox']").facebox();
			$("#buscarevento").live("click",function(){ buscarEvento();});
			 var pars="oper=showeventos";
									 
									   $("#htmleventos").html("Cargando..."); 
									   $.get("index.op.php",pars,function(x){$("#htmleventos").html(x); $("*[rel='facebox']").facebox(); reducir_imagenes() });
			
			
			
});
function reducir_imagenes()
{
	$(".img_th_evento").hide().load(function(){
	var x=$(this).width(); var y=$(this).height();
	
	var medida=120;
	var ny=(x>y) ? medida/x*y : medida ;
	var nx=(y>x) ? medida/y*x : medida ;
	
	$(".img_th_evento").width(nx).height(ny).show();
	
												});
}
	function buscarEvento()
	{
    	$("#htmleventos").html("Cargando..."); 
		var pasado=$("#pasado:checked").size();
		var txt=$("#txtevento").val();
		var cat=$("#categoria").val();
		var pars="oper=showeventos&pasado="+pasado+"&txt="+txt+"&cat="+cat;
		$.get("index.op.php",pars,function(x){$("#htmleventos").html(x); $("*[rel='facebox']").facebox(); reducir_imagenes()  });
	}
	
	
	function contadorPublico()
	{
		var x=$("#publico:checked").size(); 
		var pars="oper=contadorPublico&contador="+x;
		$.get("index.op.php",pars);
	}
	
</script>
</head>
<body>
<? include_once("panel.php");?>
<div class="containergral">
<?
$sql="select * from contexto where nombre='contadorpublico' and valor='1'";
$query=mysql_query($sql);
$row=mysql_num_rows($query);
$ch=($row==1)? "checked='checked'":"";
	echo '<div id="eventos"><img src="../images/calendar3.png" align="middle"><span class="titloevento">Eventos y Actividades</span> <span style="float:right; font-size: 14px; color: #555; line-height: 50px">Eventos Pasados: <b>'.eventosPasadosCount().'</b> | Eventos Futuros: <b>'.eventosFuturosCount().'</b><input type="checkbox" style="margin-left:25px" id="publico" name="publico" value="1" '.$ch.' onchange="contadorPublico()"> Mostrar Contador al los Visitantes</span>
	
	<div id="buscadoreventos">
	Categoría <select id="categoria"><option value="0">< Todas ></option><option value="1">Sensibilización</option><option value="2">Capacitación</option><option value="3">Asistencia</option></select>	
	<input type="text" id="txtevento"><input type="button" value="Buscar" id="buscarevento">&nbsp;&nbsp;<input type="checkbox" id="pasado" name="pasado" value="1" > Incluir eventos pasados
		
	</div>
	<div class="htmleventos" style="overflow-y: scroll; max-height: 450px"><div id="htmleventos"></div></div>
	</div>';	
	
?>
</div>
</body>
</html>
