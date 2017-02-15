<?php 
include_once('../clases/MySQL.php"');
header('Content-Type: text/html; charset=UTF-8');
$file = file_get_contents('excel.csv');
$file=utf8_encode($file);
$file_array = explode(PHP_EOL, $file);
$columns = str_getcsv($file_array[0]);
array_shift($file_array);
$mysql=MySQL::getInstance();

foreach ($file_array as $key => $row) {
	  


         $datos=explode(';',$row);
         $prov=(integer)provincia($datos[0]);

         $empresa=$datos[1];
         $nombre=$datos[2];
         $apellido=$datos[3];
         $tel=$datos[4];
         $email=$datos[5];
    

         $query = "INSERT INTO `referents`(`district_id`, `theme_id`, `name`, `surname`, `organization`, `phone`, `email`)";
		 $query .= "VALUES ('{$prov}',0,'{$nombre}','{$apellido}','{$empresa}','{$tel}','{$email}')";
       

        $mysql->setQuery($query);
        $mysql->execute();


     



}


 function provincia($name){
    $mysql=MySQL::getInstance();
    $query="select id from districts where district_name='{$name}'";
    $mysql->setQuery($query);
    $mysql->execute();
    $id=$mysql->loadObject();
    $id=$id->id;
    return $id;


}


 


?>