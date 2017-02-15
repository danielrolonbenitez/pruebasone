<?php
include('MySQL.php');


$id=$_GET['id'];
$tipo=$_GET['tipo'];




$MySQL = MySQL::getInstance();


if($tipo =="federacion"){


 $sql="SELECT * FROM eventos INNER JOIN federaciones USING(id_federacion)  where id_federacion={$id} AND fecha > '2015-01-01' ORDER BY fecha DESC";  
 $MySQL->setQuery($sql);
$resultados=$MySQL->loadObjectList();
//var_dump($resultados) or die();

}else{ 



  $sql=" SELECT * FROM eventos INNER JOIN camaras USING(id_camara)  where id_camara={$id} AND fecha > '2015-01-01'   ORDER BY fecha DESC";
$MySQL->setQuery($sql);


$resultados=$MySQL->loadObjectList();


  }//end else






?>



<html>
<head>
  <meta charset="UTF-8">
<script src='js/jquery-1.10.2.min.js'></script>
<style>
     .logo
     {
   
    margin-bottom: 15px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #666666;
    font-size: 20px;
      
     }



     .categoriaEnvento{
    display: inline-block;
    font-size: 20px;
    font-weight: normal;
    text-transform: uppercase;
    width: auto;
    background-color: #FCC67E;
    padding: 0px 5px;
    margin-right: auto;
    margin-left: 5px;
    }


 .fechahoraLugar{
    font-size: 15px;
    color: #006633;
    font-family: Helvetica;
    padding: 5px 0;
    margin-left: 5px;
    margin-right: 5px;
  }


  .texto
  {
    font-size: 15px;
    margin-left: 5px;
    margin-right: auto;
    width: 900px;
  }



</style>







</head>
<body>

                      
                     
  
 <div id="container" style="font-family: verdana;">

                    <div class="logo">
                        <img src="images/logoCame2.png" alt="" /><br>
                        <span>Mapa virtual de capacitación</span><br>
                       

                    </div><br>
                    <span style="font-weight:normal;margin-left:5px;font-size:20px;"><?php  echo utf8_decode($resultados[0]->cam_nombre); ?></span><br></br>
                  
                 




                 
                   <?php 
                     foreach($resultados as $resultado){
                      echo"<div>";
				         //begin categorias//
                                   

                                //segun el id_categoria impirme el nombre//                          
                               switch ($resultado->id_categoria) {
                               	case '01':
                               		 echo '<span class="categoriaEnvento">Sensibilización</span><br>';
                               		break;
                               	
                               		case '02':
                               		 echo '<span class="categoriaEnvento">Capacitación</span><br>';
                               		break;
                               			case '03':
                               		 echo '<span class="categoriaEnvento">Asistencia</span><br>';
                               		break;

                               	default:
                               	 echo '<span class="categoriaEnvento">Otras Actividades</span><br>';
                               		break;
                               }
                      		       

                      		      //end categorias//                         
				          echo '<span class="categoriaEnvento">'.$resultado->nombre.'</span><br>';
				             
				          
                  $f=strtotime($resultado->fecha);
                  

                 if(  $f < strtotime('2015-01-21')) {
				   			  
				 		  echo'<span class="titulo" style="font-weight:bold;font-size:20px;margin-left:5px;margin-right:auto">'.utf8_decode($resultado->titulo).'</span><br>';
                   }else{
                    echo'<span class="titulo" style="font-weight:bold;font-size:20px;margin-left:5px;margin-right:auto">'.$resultado->titulo.'</span><br>';}
                  


                    if($resultado->desc_larga !=""){
				 		  echo'<span class="texto">'.$resultado->desc_larga.'</span><br></br>';
            }
            else {
              echo'<span class="texto">'.$resultado->desc_corta.'</span><br></br>';
            }

                              //begin fotos//
                			   
                                         

                                            //var_dump($load)or die();


                                           
	                			           $load=$resultado->img;

	                			           
                                       if($load !==" "){


                                       	 $imgArray=explode(',',$resultado->img);

                                       	$cant=count($imgArray);  
				                			           for($i=0;$i<$cant;$i++){
                                                  
                                                $b=$imgArray[$i];
                                                //$b="a";

                                                $mystring = 'abc';
                                                $findme   = 'picasaweb';
                                                
                                                $pos = strpos($b, $findme);

                                          


                                                 

                                                  if($pos === false){
				                                          if($b !=''){
				                                               echo '<img src="'.$imgArray[$i].'"alt=""  style="margin:5px;width:300px;" />';
                                                      }
                                                      }

				                			           }
		                			         }


				 		  	//end fotos//


				 		  //fechas//

				 		  $fechaConvert=explode('-',$resultado->fecha);
				 		  $fechaConvert=$fechaConvert[2]."/".$fechaConvert[1]."/".$fechaConvert[0];


                if(  $f < strtotime('2015-01-21')) {
				 		  echo'<br><span class="fechahoraLugar">Fecha:'.$fechaConvert.'&nbspHora:'.$resultado->hora.'&nbsp;Lugar:'.utf8_decode($resultado->lugar).'</span>';
            }
            else {
               echo'<br><span class="fechahoraLugar">Fecha:'.$fechaConvert.'&nbsp;Hora:'.$resultado->hora.'&nbsp;Lugar:'.$resultado->lugar.'</span>';
              
            }
				 		
				   			
					echo'</div><br></br>';// end categoria

                    }?>
                   






 </div>












</body>
<script>
$(document).ready(function(){
   $('img').error(function() {
     $(this).remove();
   })
   window.print();
 });
</script>
</html>


