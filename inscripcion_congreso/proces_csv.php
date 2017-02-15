<?php 
include_once('admin/clases/MySQL.php"');
$file = file_get_contents('padron.csv');
$file_array = explode(PHP_EOL, $file);
$columns = str_getcsv($file_array[0]);
array_shift($file_array);

/*echo'<pre>';
echo $file;die;
echo'</pre>';*/


//$record=[];
$mysql=MySQL::getInstance();

foreach ($file_array as $key => $row) {
	$query = '';  
    $temprow=str_getcsv($row);


    if(count($columns)==count($temprow)){

		$record = array_combine($columns, $temprow);
        
        $nombre = trim($record['apellido_nombre']);
        $dni    = trim(str_replace('.','',$record['dni']));
        $cuil   = trim($record['cuit']);
        
        //var_dump($record);die();
	   

        $query  ="INSERT INTO `affiliates`(`number`,`fullname`, `depend`, `roll`, `date_from`, `date_to`, `status`, `cuil`, `doc_type`, `dni`, `payment`)";
         $query .= " values (0,'{$nombre}','0','0',".date('Y-m-d').",".date('Y-m-d').",'0',{$cuil},'DNI',{$dni},0)";
         
         echo $query.'<br>';

         $mysql->setQuery($query);
         $mysql->execute();
         $total[]=$key;
      


     

    }

}
 
 echo "cantidad de filas afectadas:",count($total);


?>