
$('.eliminar').on('click',function(){

var url=$(this).attr('data-id');

$('#aceptar').attr('href',url);	

});