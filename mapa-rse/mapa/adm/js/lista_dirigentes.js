// JavaScript Document


var gridimgpath = 'plugins/jquery.jqGrid-3.5.1/themes/cofee/images';
var opProvincias="25:Capital Federal;1:Gran Buenos Aires;2:Buenos Aires;3:Catamarca;4:Chaco;5:Chubut;6:Córdoba;7:Corrientes;8:Entre Rios;9:Formosa;10:Jujuy;11:La Pampa;12:La Rioja;13:Mendoza;14:Misiones;15:Neuquén;16:Río Negro;17:Salta;18:San Juan;19:San Luis;20:Santa Cruz;21:Santa Fe;22:Santiago Del Estero;23:Tierra del Fuego;24:Tucumán";


$(document).ready(function(){
var permiso=($("#permListas").val()==2)?true:false;
var opCiudades='0:';
var opFederaciones=$("#opfed").val();
var opCamaras=$("#opcam").val();

jQuery("#list2").jqGrid({
   	url:'dirigentes.list.php',
	datatype: "json",
   	colNames:['Id','Nombre', 'Apellido','Federacion','Camara','Provincia','Ciudad','Domicilio','Tel&eacute;fono Fijo','Celular','Email'],
   	colModel:[
   		{name:'id_dirigente',index:'id_dirigente', width:40,key:true},
   		{name:'nombre',index:'nombre', formoptions:{elmsuffix:' (*)'},width:250,editable:true,editoptions:{size:40},editrules:{required:true}},
   		{name:'apellido',index:'apellido',formoptions:{elmsuffix:' (*)'}, width:150,editable:true,editoptions:{size:40},editrules:{required:true}},
		{name:'federacion',index:'federacion', width:100,editable:true,edittype:"select",editoptions:{value:opFederaciones}},
		{name:'camara',index:'camara', width:100,editable:true,edittype:"select",editoptions:{value:opCamaras}},
		{name:'provincia',index:'provincia', width:100,editable:true,edittype:"select",editoptions:{value:opProvincias}},
		{name:'ciudad',index:'ciudad', width:100,editable:true,edittype:"select",editoptions:{value:opCamaras}},
		{name:'domicilio',index:'domicilio',editable:true,sortable:false},
		{name:'telefono',index:'telefono',editable:true,sortable:false},
		{name:'celular',index:'celular',editable:true,sortable:false},
		{name:'email',index:'email',editable:true,sortable:false}
		
   	
   	],
	  
	//multiselect: true, 
	editurl:"dirigentes.edit.php",
   	rowNum:50,
	rownumbers: true,
   	rowList:[30,50,100,200,500],
   	imgpath: gridimgpath,
   	pager: jQuery('#pager2'),
   	sortname: 'id_dirigente',
    viewrecords: true,
    sortorder: "asc",
	autowidth: true,
	/*scroll:false,
	scrollrows:true,*/
	shrinkToFit: true,
	toolbar : [true,"top"], 
	//cellEdit: true,
	/*	height: "150px",	 */
	caption:"Lista de Colaboradores",
	loadComplete: eachrow,
	
	
	/* estilo en filas */
	afterInsertRow: function(rowid, aData){  	
   	$("#list2").setCell(rowid,'nombre','',{'font-weight':'bold'});
		$("#list2").setCell(rowid,'apellido','',{'font-weight':'bold'});
    },
	
	
	
	
}); 



// busqueda 

$("#t_list2").height(30).hide().filterGrid("#list2",{gridModel: false,filterModel:[
	{label:'&nbsp;&nbsp;Nombre:&nbsp;', name: 'nombre', width:120},
		{label:'&nbsp;&nbsp;Apellido:&nbsp;', name: 'apellido', width:120},
		{label:'&nbsp;&nbsp;Federación:&nbsp;', name: 'federacion', width:120},
		{label:'&nbsp;&nbsp;Cámara:&nbsp;', name: 'camara', width:120},
	{label:"&nbsp;&nbsp;Provincia:&nbsp;",name:"provincia", width:80},
	{label:"&nbsp;&nbsp;Ciudad:&nbsp;",name:"ciudad", width:80}
], gridNames:true, gridToolbar: true,enableSearch:true,enableClear:true,searchButton:"Buscar",clearButton:"X Cerrar",afterClear:function(){ $("#t_list2").css("display","none");}});

// barra de navegacion //
jQuery("#list2").navGrid('#pager2',{view:true,add:permiso,edit:permiso,del:permiso,search:false},
{height:"100%",width:350,reloadAfterSubmit:true,jqModal:true, closeAfterEdit:true, truecloseOnEscape:true, bottominfo:"Los campos con (*) son requeridos"}, // edit options
{height:"100%",width:350,reloadAfterSubmit:true,closeAfterAdd: true, bottominfo:"Los campos con (*) son requeridos"}, // add options
{reloadAfterSubmit:false}, // del options
{height:"100%",width:"100%",reloadAfterSubmit:true} // search options
);

$.jgrid.edit.top= "100"; 
$.jgrid.edit.left= "350";
$.jgrid.edit.closeOnEscape=true;

$.jgrid.edit.afterShowForm=function(){ if($("#provincia").size()==0) return; pushcity() ;recoverycity();
// corregimos salida de web
/*var x=$("#cam_web").val(); if(x=='<a href="http://" style="color: green" target="_blank" title="Ir a la Web"></a>') $("#cam_web").val('');
// corregimos email
var x=$("#cam_email").val(); if(x=='<a href="mailto:" style="color: blue" target="_blank" title="Enviar Correo"></a>') $("#cam_email").val('');*/


};
$.jgrid.edit.afterclickPgButtons=function(){ if($("#provincia").size()==0) return;pushcity(); recoverycity();};


	


// reeemplazo datos en grilla despues de cargar
function eachrow()
{
/*	var ids=$("#list2").getDataIDs();
	$.each(ids,function(key,val){
	var ret = jQuery("#list2").getRowData(val);
		
	});	
	*/

}

	$(window).resize(redimencionar); redimencionar();
	$("#provincia").live("change",function(){cambiarciudad()});
	getInfoForMap(); AddButtons();
	$("*[rel='facebox']").facebox();	
});


function AddButtons()
{	

	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Seleccionar Columnas",buttonicon:"ui-icon-gear", onClickButton:function(){ $("#list2").setColumns();	}});
	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Buscar",buttonicon:"ui-icon-search", onClickButton:function(){if(jQuery("#t_list2").css("display")=="none") {$("#t_list2").css("display",""); } else { $("#t_list2").css("display","none"); } } });
	
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
	var x=$(window).height(); 
	var x2=$(window).width()-5; 
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
