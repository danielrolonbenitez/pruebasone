<div class="container"> 
    <div id="header"> 
        <ul class="topnav"> 
            <li><a href="index.php">Inicio</a></li> 
            
            <? if($perm->listas)
			{
			?>
            <li> 
                <a href="lista_camaras.php">Cámaras</a> 
               <!-- <ul class="subnav"> 
                    <li><a href="alta_camara.php">Ingresar Cámara</a></li> 
                    <li><a href="lista_camaras.php">Listar Cámaras</a></li> 
                   
                </ul> -->
            </li> 
          
          
            
            
            <li> 
                <a href="lista_federaciones.php">Federaciones</a> 
               <!-- <ul class="subnav"> 
                    <li><a href="#">Ingresar Federación</a></li> 
                    <li><a href="#">Listar Federación</a></li> 
       		   </ul> -->
            </li> 
            
                <li><a href="lista_dirigentes.php" >Colaboradores</a></li> 
                
                  <?
			}
			
			if($perm->eventos)
			{
			
			?>
                
             <li> 
                <a href="eventos.php">Eventos</a> 
                <!--<ul class="subnav"> 
                    <li><a href="#">Ingresar</a></li> 
                    <li><a href="#">Listar / Buscar</a></li>
       		   </ul> -->
            </li> 
          
          <?
		  }
		  
		  if($perm->presupuestos)
		  {
		  ?>
        
   			  <li> 
               <a href="#">Presupuesto</a> 
               <ul class="subnav"> 
                    <li><a href="lista_presu_dirigentes.php">Colaboradores</a></li> 
                    <li><a href="lista_presu_federaciones.php">Federaciones</a></li> 
                     <li><a href="lista_presu_camaras.php">Cámaras</a></li> 
                 
                </ul>
            </li> 
            
            <?
			}
			
			if($perm->exportaciones)
			{
			?>
       
       
          <li> 
               <a href="#">Exportar</a> 
               <ul class="subnav"> 
                    <li><a href="exp_camaras.php">Cámaras</a></li> 
                    <li><a href="exp_federaciones.php">Federaciones</a></li> 
                       <li><a href="exp_dirigentes.php">Colaboradores</a></li> 
                        <li><a href="exp_presupuesto_camaras.php">Presupuesto de Cámaras</a></li> 
                         <li><a href="exp_presupuesto_federaciones.php">Presupuesto de Federaciones</a></li> 
                          <li><a href="exp_presupuesto_dirigentes.php">Presupuesto de Colaboradores</a></li> 
                           <li><a href="backupDB.php">Realizar Copia de Seguridad de la Base de Datos</a></li> 
                </ul>
            </li> 
            
            <?
			}
			if($perm->usuarios)
			{
			?>
            
          <li><a href="lista_usuarios.php">Usuarios</a>
          <?
		  }
		  ?>
      	</li> 
                
                            
             <li><a href="../index.php" target="_blank">Ver Sitio</a></li> 
         
             <li><a href="logout.php">Cerrar Sesión</a></li> 
            
        </ul> 
    </div>
</div>
