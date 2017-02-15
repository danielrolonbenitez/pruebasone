// JavaScript Document


var gridimgpath = 'plugins/jquery.jqGrid-3.5.1/themes/cofee/images';
var opPermisos="0:Sin Permiso;1:Leer;2:Leer y Editar";
var opPermisos2="0:Sin Permiso;1:Leer";

$(document).ready(function(){


jQuery("#list2").jqGrid({
   	url:'usuarios.list.php',
	datatype: "json",
   	colNames:['Id','Nombre', 'Usuario','Clave','Listas','Eventos','Presupuestos','Exportaciones'],
   	colModel:[
   	{name:'id_usuario',index:'id_usuario', width:40,key:true, editable: false},
   	{name:'nombre',index:'nombre',editable:true,sortable:false,editrules:{required:true},formoptions:{elmsuffix:' (*)'},editoptions:{size:40}, align:"center", width:300},
	{name:'usuario',index:'usuario',editable:true,sortable:false,editrules:{required:true},formoptions:{elmsuffix:' (*)'},editoptions:{size:40}, align:"center"},
	{name:'clave',index:'clave',editable:true,sortable:false,editrules:{required:true},formoptions:{elmsuffix:' (*)'},editoptions:{size:40}, align:"center"},
	{name:'listas',index:'listas',editable:true,sortable:false, edittype:"select",editoptions:{value:opPermisos}, align:"center"},
	{name:'evento',index:'evento',editable:true,sortable:false,edittype:"select",editoptions:{value:opPermisos}, align:"center"},
	{name:'presupuestos',index:'presupuestos',editable:true,sortable:false,edittype:"select",editoptions:{value:opPermisos}, align:"center"},
	{name:'exportaciones',index:'exportaciones',editable:true,sortable:false,edittype:"select",editoptions:{value:opPermisos2}, align:"center"}
		
   	
   	],
	  
	//multiselect: true, 
	editurl:"usuarios.edit.php",
   	rowNum:50,
	rownumbers: false,
   	imgpath: gridimgpath,
   	pager: jQuery('#pager2'),
   	sortname: 'id_usuario',
    viewrecords: true,
    sortorder: "asc",
	autowidth: true,
	/*scroll:false,
	scrollrows:true,*/
	shrinkToFit: true,
	
	//cellEdit: true,
	/*	height: "150px",	 */
	caption:"Lista de Usuarios y Permisos",
	loadComplete: eachrow,
	
	
	/* estilo en filas */
	afterInsertRow: function(rowid, aData){  	
	
	if(aData.listas==0) var Alistas="Sin Permiso";
	if(aData.listas==1) var Alistas="Leer";
	if(aData.listas==2) var Alistas="Leer y Editar";
	
	if(aData.evento==0) var Aeventos="Sin Permiso";
	if(aData.evento==1) var Aeventos="Leer";
	if(aData.evento==2) var Aeventos="Leer y Editar";
	
	if(aData.presupuestos==0) var Apresupuestos="Sin Permiso";
	if(aData.presupuestos==1) var Apresupuestos="Leer";
	if(aData.presupuestos==2) var Apresupuestos="Leer y Editar";
	
	if(aData.exportaciones==0) var Aexportaciones="Sin Permiso";
	if(aData.exportaciones==1) var Aexportaciones="Leer";
	if(aData.exportaciones==2) var Aexportaciones="Leer y Editar";
	
   	$("#list2").setCell(rowid,'nombre','',{'font-weight':'bold'});
	
		$("#list2").setCell(rowid,'apellido','',{'font-weight':'bold'});
			$("#list2").setCell(rowid,'listas',Alistas,{'color':'#red'});
			$("#list2").setCell(rowid,'evento',Aeventos,{'color':'#red'});
			$("#list2").setCell(rowid,'presupuestos',Apresupuestos,{'color':'#red'});
			$("#list2").setCell(rowid,'exportaciones',Aexportaciones,{'color':'#red'});
    },
	
	
	
	
}); 





// barra de navegacion //
jQuery("#list2").navGrid('#pager2',{view:false,add:true,edit:true,del:true,search:false},
{height:"100%",width:"100%",reloadAfterSubmit:true,jqModal:true, closeAfterEdit:true, truecloseOnEscape:true, bottominfo:"Los campos con (*) son requeridos"}, // edit options
{width:"100%",reloadAfterSubmit:true,closeAfterAdd: true, bottominfo:"Los campos con (*) son requeridos"}, // add options
{reloadAfterSubmit:false}, // del options
{height:"100%",width:"100%",reloadAfterSubmit:true} // search options
);

$.jgrid.edit.top= "100"; 
$.jgrid.edit.left= "350";
$.jgrid.edit.closeOnEscape=true;





	


// reeemplazo datos en grilla despues de cargar
function eachrow()
{
	var ids=$("#list2").getDataIDs();
	$.each(ids,function(key,val){
	
	//$("#list2").setRowData(val,{clave:"******"});	
	
		
	});	
	

}

	$(window).resize(redimencionar); redimencionar();
	$("#provincia").live("change",function(){cambiarciudad()});
	getInfoForMap(); AddButtons();
	$("*[rel='facebox']").facebox();	
});


function AddButtons()
{	

	
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
	var x2=900;//$(window).width()-5; 
	var y=$("#list2").position();
	var y=255;
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
