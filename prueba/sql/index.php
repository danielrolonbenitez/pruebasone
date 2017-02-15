<?php 
      include('Clases/MySQL.php');
      echo "begin procedure";

      echo "pepe";
   
      
                $sql = "CALL pepe()";
                $MySQL=MySQL::getInstance();
				$res=$MySQL->setQuery($sql);
				$MySQL->execute();
				$res=$MySQL->loadObjectList();
				var_dump($res);
				//$estado=$MySQL->loadObjectList();

/*           $mysqli = new mysqli("localhost", "root",'', "fenix");
 
/*Y llamamos al procedimiento para recoger los datos*/
/*Si falla imprimimos el error*/
if (!($res = $mysqli->query("CALL pepe()"))) {
    echo "Falló la llamada: (" . $mysqli->errno . ") " . $mysqli->error;
}
 
/*E imprimimos el resultado para ver que el ejemplo ha funcionado*/
//var_dump($res->fetch_assoc());



   var_dump($estado);
   





?>