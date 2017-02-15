

function changestado(){
$("#estado").attr('value','0');
}





    $('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#rubro'); });  
    $('.quitar').click(function() { return !$('#rubro option:selected').remove().appendTo('#origen'); });
    $('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#rubro'); }); });
    $('.quitartodos').click(function() { $('#rubro option').each(function() { $(this).remove().appendTo('#origen'); }); });

