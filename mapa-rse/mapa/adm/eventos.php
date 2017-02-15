<? include_once("init.php");
if(!$perm->eventos) { header("location: index.php");exit; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_titulopagina_?></title>
<link href="images/panel.css" rel="stylesheet" type="text/css" />
<link href="adm.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="plugins/jquery.jqGrid-3.5.1/css/jquery-ui-1.7.2.custom.css"/>
<link rel="stylesheet" type="text/css" href="plugins/jquery.jqGrid-3.5.1/css/ui.jqgrid.css"/> 
<link href="plugins/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<link href="plugins/jquery-autocomplete/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script>var iscam=false;</script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery-1.3.2.min.js"></script>
<script src="plugins/facebox/facebox.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery-ui-1.7.1.custom.min.js"></script>
<script src="plugins/ui/i18n/ui.datepicker-es.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/i18n/grid.locale-sp.js"></script>
<script src="plugins/jquery.jqGrid-3.5.1/js/jquery.jqGrid.min.js"></script>
<script src="plugins/jquery-autocomplete/jquery.autocomplete.min.js"></script>
<script src="js/panel.js"></script>
<script src="js/lista_eventos.js"></script>
<script>
$(document).ready(function(){
			
			$("#buscador").autocomplete('eventos.op.php?search=1',{
		 minChars:3, matchSubset:false, matchContains:true, cacheLength:10,  selectOnly:1,width:500	
			}).result(function(a,data,key){searchCam(data)});
			
			$("input:first").focus().click(function(){$(this).val('');});
			
			
});
var idcam=0;
function searchCam(data)
{
	$("#tabla").show();	
	var x=data[1];
	x=x.split("-");
	var id=x[0];
	var iscam=x[1];
	
	$("#list2").setGridParam({editurl:"eventos.edit.php?idcam="+id+"&iscam="+iscam});
	$("#list2").setGridParam({url:"eventos.list.php?id="+id+"&iscam="+iscam}).trigger("reloadGrid");
	$("#list2").setCaption("Eventos - "+data[0]);
	
}
</script>
</head>
<body>
<input type="hidden" id="permEventos" value="<?=$perm->eventos?>" />
<? include_once("panel.php");?>
<div class="containergral">
Busque la Cámara o Federación
  <input type="text" id="buscador" size="70" style="border:1px solid #c5dbec; padding:3px" />
<br />
<br />
<div id="tabla" style="display:none">
          <table id="list2"  class="scroll" cellpadding="0" cellspacing="0"></table>
          <div id="pager2" class="scroll" style="text-align:center;"></div>
          </div>
</div>
</body>
</html>
