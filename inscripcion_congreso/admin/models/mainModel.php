<?php

class MainModel {

    private $MySQL;
    public function __construct(){
        $this->MySQL = MySQL::getInstance();
    }
	
	//Funciones Inscriptos
	
    public function traerInscripto($id){		
      $sql = "SELECT * from enrolled WHERE id = {$id}";
      $this->MySQL->setQuery($sql);
	  return $this->MySQL->loadObject();
	}
	
    public function listarInscriptos($search=array()){		
      $sql = "SELECT * from enrolled
	  WHERE 1";
		if(count($search)>0){
			foreach($search as $key => $value){
				$sql .= " AND {$key} {$value}";
			}
		}
      $this->MySQL->setQuery($sql);
	  return $this->MySQL->loadObjectList();
    }
	
    public function traerInscriptoDNI($dni){	
		$dni = preg_replace("/[^0-9]/", "",$dni);		
		$sql = "SELECT * from enrolled WHERE dni = {$dni}";
		$this->MySQL->setQuery($sql);
		return $this->MySQL->loadObject();
	}
	
    public function buscarAfiliado($dni){	
		$dni = preg_replace("/[^0-9]/", "",$dni);		
		$sql = "SELECT * from affiliates WHERE dni = '$dni'";
		$this->MySQL->setQuery($sql);
		return $this->MySQL->loadObject();
    }


   public function cantidadInscriptoPorComicion(){

   		$sql = "SELECT * from enrolled WHERE fcomicion ='Viernes 21 de Octubre'";
		$this->MySQL->setQuery($sql);
		$cantidad['viernes']=$this->MySQL->getNumRows();
		
		$sql = "SELECT * from enrolled WHERE fcomicion ='Sabado 22 de Octubre'";
		$this->MySQL->setQuery($sql);
		$cantidad['sabado']=$this->MySQL->getNumRows();
		
		return $cantidad;


   }

   public function validateDNI($dni){
		$sql = "SELECT * from affiliates WHERE dni = $dni ";

		$this->MySQL->setQuery($sql);
		if($this->MySQL->getNumRows() != 1){
			return false;
		} else {
			return true;
		}
	}


  





	
}
?>
