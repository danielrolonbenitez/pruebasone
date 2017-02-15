// JavaScript Document

var gridimgpath = 'plugins/jquery.jqGrid-3.5.1/themes/cofee/images';
var opProvincias="25:Capital Federal;1:Gran Buenos Aires;2:Buenos Aires;3:Catamarca;4:Chaco;5:Chubut;6:Córdoba;7:Corrientes;8:Entre Rios;9:Formosa;10:Jujuy;11:La Pampa;12:La Rioja;13:Mendoza;14:Misiones;15:Neuquén;16:Río Negro;17:Salta;18:San Juan;19:San Luis;20:Santa Cruz;21:Santa Fe;22:Santiago Del Estero;23:Tierra del Fuego;24:Tucumán";


$(document).ready(function(){
var opCiudades='0:';

var permiso=($("#permListas").val()==2)?true:false;

jQuery("#list2").jqGrid({
   	url:'camaras.list.php',
	datatype: "json",
   	colNames:['Id','Nombre', 'Sigla','Federación','Provincia','Ciudad','Calle','Numero','Piso/Of/Depto','Teléfono','Fax','Email','Web','Descripcion','Mapa'],
   	colModel:[
   		{name:'id_camara',index:'id_camara', width:40,key:true},
   		{name:'cam_nombre',index:'cam_nombre', formoptions:{elmsuffix:' (*)'},width:250,editable:true,editoptions:{size:40},editrules:{required:true}},
   		{name:'cam_abreviacion',index:'cam_abreviacion',formoptions:{elmsuffix:' (*)'}, width:150,editable:true,editoptions:{size:40},editrules:{required:true}},
		{name:'federacion',index:'federacion', width:100,editable:true,edittype:"select",editoptions:{value:opFederaciones}},
   		{name:'provincia',index:'provincia',formoptions:{elmsuffix:' (*)'}, width:150, align:"left",editable:true,edittype:"select",editoptions:{value:opProvincias},editrules:{minValue:1}},
		{name:'ciudad',index:'ciudad',formoptions:{elmsuffix:' (*)'}, width:150, align:"left",editable:true,edittype:"select",editoptions:{value:opCiudades}},		
   		{name:'cam_calle',index:'cam_calle',formoptions:{elmsuffix:' (*)'}, width:150,align:"left", sortable:false,editable:true,editoptions:{size:40},editrules:{required:true}},	
		{name:'cam_calle_numero',index:'cam_calle_numero', formoptions:{elmsuffix:' (*)'},width:80,align:"left", sortable:false,editable:true,editoptions:{size:40},editrules:{required:true}},
		{name:'cam_of',index:'cam_of', width:80,align:"left", sortable:false,editable:true,editoptions:{size:40}},
			
   		{name:'cam_telefono',index:'cam_telefono', sortable:false,editable:true,editoptions:{size:40}},
		{name:'cam_fax',index:'cam_fax', sortable:false,editable:true,editoptions:{size:40}},		
		{name:'cam_email',index:'cam_email', width:100, sortable:false,editable:true, formatoptions:{target:'_blank'},editoptions:{size:40}}	,
		{name:'cam_web',index:'cam_web', width:150, sortable:false,editable:true,editoptions:{size:40},formatoptions:{target:'_blank'}}	,
		{name:'cam_descripcion',index:'cam_descripcion',  sortable:false,editable:true,edittype:"textarea",editoptions:{rows:"4",cols:"40"}},
		{name:'mapa',index:'mapa', width:100, sortable:true,editable:false, align: "center"}	
   	],
	  
	//multiselect: true, 
	editurl:"camaras.edit.php",
   	rowNum:50,
	rownumbers: true,
   	rowList:[30,50,100,200,500],
   	imgpath: gridimgpath,
   	pager: jQuery('#pager2'),
   	sortname: 'id_camara',
    viewrecords: true,
    sortorder: "asc",
	autowidth: true,
	/*scroll:false,
	scrollrows:true,*/
	shrinkToFit: true,
	toolbar : [true,"top"], 
	//cellEdit: true,
	/*	height: "150px",	 */
	caption:"Lista de Cámaras",
	loadComplete: eachrow,
	
	
	
	/* estilo en filas */
	afterInsertRow: function(rowid, aData){  	
   	$("#list2").setCell(rowid,'cam_nombre','',{'font-weight':'bold'});
    },
	
	
	/****  COMISIONES  ****/
	subGrid: true,
	subGridRowExpanded: function(subgrid_id, row_id) {
	var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"comisiones.list.php?id="+row_id,
			datatype: "json",
			colNames: ['id','Nombre','Cargo','email'],
			colModel: [
				{name:"id",index:"id",width:80,key:true,hidden:true,editable:true,editoptions:{size:40},editrules:{required:true}},
				{name:"nombre",index:"nombre",width:180,editable:true,editoptions:{size:40},editrules:{required:true}},
				{name:"cargo",index:"cargo",width:100,editable:true,editoptions:{size:40},editrules:{required:true}},
				{name:"email",index:"email",width:180,editable:true,editoptions:{size:40},editrules:{required:true}}
			],
		   	rowNum:120,
			viewrecords: true,
			editurl:"comisiones.edit.php?id="+row_id,
		   	pager: pager_id,
		   	imgpath: gridimgpath,
		   	caption:"Integrantes de la Cámara",
		    height: '100%',
			width: '100%',
			afterInsertRow: function(rowid, aData){$("#"+subgrid_table_id).setCell(rowid,'nombre','',{'font-weight':'bold'});}
			
		}).navGrid("#"+pager_id,{edit:true,add:true,del:true,search:false})
	}
	/****  FIN COMISIONES  ****/
	
}); 



// busqueda 
$("#t_list2").height(30).hide().filterGrid("#list2",{gridModel: false,filterModel:[
	{label:'&nbsp;&nbsp;Nombre:&nbsp;', name: 'cam_nombre', width:120},
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
var x=$("#cam_web").val(); if(x=='<a href="http://" style="color: green" target="_blank" title="Ir a la Web"></a>') $("#cam_web").val('');
// corregimos email
var x=$("#cam_email").val(); if(x=='<a href="mailto:" style="color: blue" target="_blank" title="Enviar Correo"></a>') $("#cam_email").val('');


};
$.jgrid.edit.afterclickPgButtons=function(){ if($("#provincia").size()==0) return;pushcity(); recoverycity();};


	


// reeemplazo datos en grilla despues de cargar
function eachrow()
{
	var ids=$("#list2").getDataIDs();
	$.each(ids,function(key,val){
	var ret = jQuery("#list2").getRowData(val);
	var x="<img src='images/mapas0-pendiente.png' id='pendiente"+val+"' title='Geolocalización en Proceso'>"; 
	
	switch (ret.mapa)
	{
		case "1": var x="<img src='images/mapa1-localizado.png' title='Geolocalizado Correctamente' style='cursor:pointer' onclick='vermapa("+ret.id_camara+")'>";  break;
		case "2": var x="<img style='cursor:pointer' src='images/mapa2-nolocalizado.png' title='Dirección no encontrada, haga click para intentarlo nuevamente.' onclick='mapa_reload("+ret.id_camara+");this.src=\"images/mapas0-pendiente.png\"; this.title=\"Geolozalización en Proceso\" '>";break;
	}
	$("#list2").setRowData(val,{mapa:x});	
	//$("#list2").setRowData(val,{cam_email:"<a href='mailto:"+ret.cam_email+"' style='color: blue' target='_blank' title='Enviar Correo'>"+ret.cam_email+"</a>"});
//	$("#list2").setRowData(val,{cam_web:"<a href='http://"+tratoUrl(ret.cam_web)+"' style='color: green' target='_blank' title='Ir a la Web'>"+tratoUrl(ret.cam_web)+"</a>"});

	
	});	

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

function vermapa(id)
{
	
	if($("#vermapa").size()==0) crearVentanaMapa();
	$("#vermapa").removeShadow();
	$("#vermapa").remove(); 
	crearVentanaMapa();
	$("#vermapa iframe").attr("src","map-i.php?id="+id);
	$("#vermapa").show();
	var mh=$("#vermapa").height()/2;
	var mw=$("#vermapa").width()/2;
	
	var x=$(document).width()/2-mw;
	var y=$(document).height()/2-mh; 	
	$("#vermapa").css({top:y,left:x}).dropShadow();
	 
	
}
	
function crearVentanaMapa()
{
	
	$("body").prepend('<div id="vermapa" class="vermapa"><iframe src="map-i.php" frameborder="0" height="420px" width="500px" scrolling="no"></iframe></div>');
}


function cerrarmapa()
{
		$("#vermapa").hide();
		$("#vermapa").removeShadow();
}