<?php
@set_time_limit(0);
class MainController {
    private $MySQL;
	private $maxInsPermitido =980;
	public function __construct(){
        $this->MySQL = MySQL::getInstance();
	}
	
	public function nuevaInscripcion($datos){
	
		$dni = preg_replace("/[^0-9]/", "",$datos['dni']);
		$district = preg_replace("/[^0-9]/", "",$datos['district']);
		
		$sql = "INSERT INTO enrolled SET ";
		$sql .= "name = '".strtoupper($datos['name'])."', ";
		$sql .= "last_name = '".strtoupper(trim($datos['last_name']))."',";
		$sql .= "dni = '{$dni}', ";
		$sql .= "email = '{$datos['email']}', ";
		$sql .= "cellphone = '{$datos['cellphone']}', ";
		$sql .= "phone = '{$datos['phone']}', ";
		$sql .= "school = '".strtoupper($datos['school'])."', ";
		$sql .= "district = '{$district}',";
		$sql .= "position = '".strtoupper($datos['position'])."', ";
		$sql .= "area = '".strtoupper($datos['area'])."', ";
		$sql .= "abstract = 0, ";
		$sql .= "affiliate = '{$datos['affiliate']}', ";
		$sql .= "payment = '{$datos['payment']}', ";
		$sql .= "fcomicion = '{$datos['fcomicion']}', ";
		$sql .= "datetime = NOW() ";
       

		$this->MySQL->setQuery($sql);
		$this->MySQL->execute();
		$id = $this->MySQL->getId();
		

       //this->count id = 980 insertar 20
         $sql="SELECT count(id) as cantidad FROM  enrolled";
		 $this->MySQL->setQuery($sql);
         $this->MySQL->execute();
         $cantidadIns=$this->MySQL->loadObject();
         //var_dump($cantidadIns);die();
             if((integer)$cantidadIns->cantidad == $this->maxInsPermitido){
             	    // var_dump($cantidadIns);die();
       			    $this->insertarRegistrosReservado();
				 }
          


		return $id;
	}
	
	public function actualizarAbstracts($datos){
	
		foreach($datos['datos'] as $id => $dato){
		
			$sql = "UPDATE enrolled SET ";
			
			$sql .= "affiliate = '{$dato['affiliate']}', ";
			$sql .= "payment = '{$dato['payment']}', ";
			$sql .= "abstract = '{$dato['abstract']}' ";
			
			$sql .= "WHERE id = '{$id}' ";
			$this->MySQL->setQuery($sql);
			$this->MySQL->execute();
			
			//echo $sql;
		}
		
		return true;
		
	}
	
	public function actualizarInscripto($datos){
	
		$dni = preg_replace("/[^0-9]/", "",$datos['dni']);
		$district = preg_replace("/[^0-9]/", "",$datos['district']);
		
		$sql = "UPDATE enrolled SET ";
		
		$sql .= "name = '".strtoupper($datos['name'])."', ";
		$sql .= "last_name = '".strtoupper($datos['last_name'])."', ";
		$sql .= "dni = '{$dni}', ";
		$sql .= "email = '{$datos['email']}', ";
		$sql .= "cellphone = '{$datos['cellphone']}', ";
		$sql .= "phone = '{$datos['phone']}', ";
		$sql .= "school = '".strtoupper($datos['school'])."', ";
		$sql .= "district = '{$district}', ";
		$sql .= "position = '".strtoupper($datos['position'])."', ";
		$sql .= "area = '".strtoupper($datos['area'])."', ";
		
		$sql .= "affiliate = '{$datos['affiliate']}', ";
		$sql .= "payment = '{$datos['payment']}', ";
		$sql .= "abstract = '{$datos['abstract']}' ";
		
		$sql .= "WHERE id = '{$datos['id']}' ";
		$this->MySQL->setQuery($sql);
		$this->MySQL->execute();
		
		return true;
		
	}

}

?>