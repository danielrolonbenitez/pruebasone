function eliminarMenu(id){
	if(!confirm("Seguro que desea borrar este item?")){
		return false;
	}
	else{
		jQuery.post("background.php",{ op:'borrar_menu',id:id},
				function(data){
					window.location.reload();
				});
	}
}
function eliminarUsuario(id){
	if(!confirm("Seguro que desea borrar este usuario?")){
		return false;
	}
	else{
		jQuery.post("background.php",{ op:'borrar_usuario',id:id},
				function(data){
					//window.location.reload();
				});
	}
}
function eliminarTurno(id){
	if(!confirm("Seguro que desea borrar este turno?")){
		return false;
	}
	else{
		jQuery.post("background.php",{ op:'borrar_turno',id:id},
				function(data){
					window.location.reload();
				});
	}
}
function eliminarCupoTurno(id){
	if(!confirm("Seguro que desea borrar el cupo de este dia?")){
		return false;
	}
	else{
		jQuery.post("background.php",{ op:'borrar_cupo_turno',id:id},
				function(data){
					window.location.reload();
				});
	}
}
function eliminarCupoVianda(id){
	if(!confirm("Seguro que desea borrar el cupo de este dia?")){
		return false;
	}
	else{
		jQuery.post("background.php",{ op:'borrar_cupo_vianda',id:id},
				function(data){
					window.location.reload();
				});
	}
}