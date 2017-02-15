// JavaScript Document


$(document).ready(function(){
				var permiso=($("#permEventos").val()==2)?true:false;				  
var opCat={1:"Sensibilización",2:"Capacitación",3:"Asistencia"};
$("#list2").jqGrid({
   	url:'eventos.list.php',
	datatype: "json",
   	colNames:['Id','Categoría','Título', 'Fecha','Horario','Lugar','Texto Corto','Texto Largo','Web','Galería', 'Nota'],
   	colModel:[
			  
   		{name:'id_evento',index:'id_evento', width:40,key:true},
		{name:'categoria',index:'categoria', editable:true,edittype:"select",editoptions:{value:opCat},editrules:{required:true}},
		{name:'titulo',index:'titulo', width:200, editable:true,editoptions:{size:40},editrules:{required:true}},
		{name:'fecha',index:'fecha', width:80,editable:true,editoptions:{dataInit:function(e){$(e).datepicker({dateFormat:'dd/mm/yy'});},size:10}},
		{name:'horario',index:'horario', width:60,editable:true,editoptions:{size:10}, sortable:false,formoptions:{elmsuffix:' hh:mm (24hs)'}},
		{name:'lugar',index:'lugar', width:120,editable:true, sortable:false,editoptions:{size:40}},
		{name:'texto_corto',index:'texto_corto',editable:true,editoptions:{size:40},editrules:{required:true}, sortable:false,edittype:"textarea",editoptions:{rows:"4",cols:"40"}},
		{name:'texto_largo',index:'texto_largo', editable:true,editrules:{required:true}, sortable:false,edittype:"textarea",editoptions:{rows:"4",cols:"40"}},
		{name:'link',index:'link', width:120,editable:true,editoptions:{size:40},sortable:false,formatter:'', formatoptions:{target:'_blank'}},	   		
		{name:'img',index:'img', width:120,editable:true,editoptions:{size:40},sortable:false,formatter:'', formatoptions:{target:'_blank'}},	   		
		{name:'nota',index:'nota', width:120,editable:true,editoptions:{size:40},sortable:false,formatter:'', formatoptions:{target:'_blank'}},	   		
   	],
	//multiselect: true, 
	
	editurl:"eventos.edit.php",
	loadComplete: eachrow,
	/* estilo en filas */
	afterInsertRow: function(rowid, aData){  	
   	$("#list2").setCell(rowid,'titulo','',{'font-weight':'bold'});
    },
	
   	rowNum:50,
	rownumbers: true,
   	rowList:[30,50,100,150,200,500,1000],
   	pager: jQuery('#pager2'),
   	sortname: 'fecha',
    viewrecords: true,
    sortorder: "desc",
	autowidth: true,
	/*scroll:false,
	scrollrows:true,*/
	shrinkToFit: true,
	toolbar : [true,"top"], 
	//cellEdit: true,
	/*	height: "150px",	 */
	caption:"Eventos"
}); 

// busqueda 
$("#t_list2").height(30).hide().filterGrid("#list2",{gridModel: false,filterModel:[
	{label:'&nbsp;&nbsp;Categoría:&nbsp;', name: 'categoria', width:120},
	{label:"&nbsp;&nbsp;Titulo:&nbsp;",name:"titulo", width:80}

], gridNames:true, gridToolbar: true,enableSearch:true,enableClear:true,searchButton:"Buscar",clearButton:"X Cerrar",afterClear:function(){ $("#t_list2").css("display","none");}}); 
// barra de navegacion //



$("#list2").navGrid('#pager2',{view:true,add:permiso,edit:permiso,del:permiso,search:false},
{height:"100%",width:"100%",reloadAfterSubmit:true,jqModal:true, closeAfterEdit:true, truecloseOnEscape:true, bottominfo:"Los campos con (*) son requeridos"}, // edit options
{height:"100%",width:"100%",reloadAfterSubmit:true,closeAfterAdd: true, bottominfo:"Los campos con (*) son requeridos"}, // add options
{reloadAfterSubmit:false}, // del options
{height:"100%",width:"100%",reloadAfterSubmit:true} // search options
);

$.jgrid.edit.top= "100"; 
$.jgrid.edit.left= "350";
$.jgrid.edit.closeOnEscape=true;

$.jgrid.edit.afterShowForm=function(){ 
// corregimos salida de web
var x=$("#link").val(); if(x=='<a href="http://" style="color: green" target="_blank" title="Ir a la Web"></a>') $("#link").val('');
var x=$("#img").val(); if(x=='<A style="COLOR: green" title="Ver la Imagen" href="" target=_blank></A>') $("#img").val('');


};

$(window).resize(redimencionar); redimencionar();
$("#provincia").live("change",function(){cambiarciudad()});
AddButtons(); $("*[rel='facebox']").facebox();	
}); // fin init

function pickdates(id){
	jQuery("#"+id+"_fecha","#list2").datepicker({dateFormat:"dd-mm-yy"});
}


function eachrow()
{
	var ids=$("#list2").getDataIDs();
	$.each(ids,function(key,val){
	var ret = jQuery("#list2").getRowData(val);
	
	$("#list2").setRowData(val,{link:"<a href='http://"+tratoUrl(ret.link)+"' style='color: green' target='_blank' title='Ir a la Web'>"+tratoUrl(ret.link)+"</a>",img:"<a href='"+ret.img+"' style='color: green' target='_blank' title='Ver la Imagen'>"+ret.img+"</a>"});
	


	
						});
	
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
	x=str_replace("http:"+"/"+"/","",x);
	x=str_replace("HTTP:"+"/"+"/","",x);
	x=str_replace("Http:"+"/"+"/","",x);

	return x;
}	

function AddButtons()
{	

	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Seleccionar Columnas",buttonicon:"ui-icon-gear", onClickButton:function(){ $("#list2").setColumns();	}});
	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Buscar",buttonicon:"ui-icon-search", onClickButton:function(){if(jQuery("#t_list2").css("display")=="none") {$("#t_list2").css("display",""); } else { $("#t_list2").css("display","none"); } } });
	
	$("#list2").navButtonAdd("#pager2",{caption:"",title:"Video Tutorial",buttonicon:"ui-icon-video",position: "last", onClickButton:function(){ $("#video").click();}});
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
	$("#list2").setGridHeight(x-y-80);
	$("#list2").setGridWidth(960);
}