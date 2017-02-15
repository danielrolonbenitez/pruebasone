// JavaScript Document


var gridimgpath = 'plugins/jquery.jqGrid-3.5.1/themes/cofee/images';

$(document).ready(function(){
var permiso=($("#permPresupuestos").val()==2)?true:false;	
jQuery("#list2").jqGrid({
   	url:'presupuesto.list.php?tipo=d',
	datatype: "json",
   	colNames:['Id','Colaborador','Provincia','Ciudad','Recaudación','Presupuesto Aprobado','Fecha de Aprobación','Consumido','Saldo','Pagos Extaordinarios'],
   	colModel:[
   		
		{name:'id',index:'id', width:50,editable:false, key:true},
		{name:'dirigente',index:'dirigente', editable: false},
		{name:'provincia',index:'provincia', editable: false},
		{name:'ciudad',index:'ciudad', editable: false},
		{name:'recaudacion',index:'recaudacion', editable: true,editrules:{number:true}},
		{name:'presupuesto',index:'presupuesto', width:180, editable: true,editrules:{number:true}},
		{name:'fecha',index:'fecha',  width:160,editable:true,editoptions:{dataInit:function(e){$(e).datepicker({dateFormat:'dd/mm/yy'});},size:10}},
		{name:'consumido',index:'consumido', editable: true,editrules:{number:true}},
		{name:'saldo',index:'saldo', editable: true,editrules:{number:true}},
		{name:'pagos',index:'pagos', editable: true,editrules:{number:true}}
  	
   	],
	  
	//multiselect: true, 
	cellEdit: true,
	cellurl:"presupuesto.edit.php?tipo=d",
   	rowNum:50,
	rownumbers: true,
   	rowList:[30,50,100,200,500],
   	imgpath: gridimgpath,
   	pager: jQuery('#pager2'),
   	sortname: 'd.id_dirigente',
    viewrecords: true,
	forceFit : true,
    sortorder: "asc",
	autowidth: true,
	/*scroll:false,
	scrollrows:true,*/
	shrinkToFit: true,

	/*	height: "150px",	 */
	caption:"Presupuesto - Colaboradores",
	loadComplete: eachrow,
	
	
	/* estilo en filas */
	afterInsertRow: function(rowid, aData){  	
   	$("#list2").setCell(rowid,'dirigente','',{'font-weight':'bold'});
	
    },
	

}); 

// barra de navegacion //
jQuery("#list2").navGrid('#pager2',{view:false,add:permiso,edit:permiso,del:permiso,search:true},
{height:"100%",width:350,reloadAfterSubmit:true,jqModal:true, closeAfterEdit:true, truecloseOnEscape:true, bottominfo:"Los campos con (*) son requeridos"}, // edit options
{height:"100%",width:350,reloadAfterSubmit:true,closeAfterAdd: true, bottominfo:"Los campos con (*) son requeridos"}, // add options
{reloadAfterSubmit:false}, // del options
{height:"100%",width:"100%",reloadAfterSubmit:true} // search options
);

$.jgrid.edit.top= "100"; 
$.jgrid.edit.left= "350";
$.jgrid.edit.closeOnEscape=true;



// reeemplazo datos en grilla despues de cargar


	$(window).resize(redimencionar); redimencionar();
	$("#provincia").live("change",function(){cambiarciudad()});
	getInfoForMap(); AddButtons();
	$("*[rel='facebox']").facebox();	
});


function eachrow()
{
	var ids=$("#list2").getDataIDs();
	$.each(ids,function(key,val){
	var ret = jQuery("#list2").getRowData(val);
	if(ret.fecha=="//" || ret.fecha=='00/00/0000')	$("#list2").setRowData(val,{fecha:""});	
	});	
	

}

function AddButtons()
{	

	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Seleccionar Columnas",buttonicon:"ui-icon-gear", onClickButton:function(){ $("#list2").setColumns();	}});
	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Video Tutorial",buttonicon:"ui-icon-video",position: "last", onClickButton:function(){$("#video").click();}});
}



function cambiarciudad()
{	pushcity(); }

function recoverycity()
{
		var row=$("#list2").getGridParam("selrow");
		var ret=$("#list2").getRowData(row);
		var ciudad=(ret.ciudad); 
		$("#ciudad option:contains("+ciudad+")").attr("selected","selected");
}

function redimencionar()
{
	
	// HACEMOS EL ALTO AUTOMATICO //
	//	$("#list2").css("position","absolute");
	var x=$(window).height()-20; 
	var x2=900;//$(window).width()-5; 
	var y=$("#list2").position();
	var y=215;
	if($.browser.msie) { y+=0; x2=x2-2;}
	$("#list2").setGridHeight(x-y);
	$("#list2").setGridWidth(x2);
}

function str_replace(busca, repla, orig)
{
	str 	= new String(orig);
	rExp	= "/"+busca+"/g";
	rExp	= eval(rExp);
	newS	= String(repla);
	str = new String(str.replace(rExp, newS));
	return str;
}

function tratoUrl(x)
{
	x=str_replace("http://","",x);
	x=str_replace("HTTP://","",x);
	x=str_replace("Http://","",x);
	return x;
}	
