<?php
include("clases/PHPExcel.php");
class exportarModel extends mainModel {
	
	private $sql = '';
    public function __construct(){
        $this->MySQL = MySQL::getInstance();
	}
	
	protected function registradosGetAllByCode(){
		$sql=sprintf("SELECT id,name AS 'nombre',last_name AS 'apellido',email,dni,cellphone AS 'celular',school AS 'escuela',position AS 'cargo',district AS 'distrito', abstract AS 'eje' FROM enrolled  WHERE payment = 1 AND abstract > 0  AND affiliate = 1 ORDER BY id ASC");
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}
	
	protected function registradosGetAllByNameAsc(){
		$sql=sprintf("SELECT id,name AS 'nombre',last_name AS 'apellido',email,dni,cellphone AS 'celular',school AS 'escuela',position AS 'cargo',district AS 'distrito', abstract AS 'eje' ,fcomicion FROM enrolled  WHERE payment = 1 AND abstract > 0  AND affiliate = 1 ORDER BY last_name ASC");
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}

	protected function ejesGetAll(){
		$sql=sprintf("SELECT DISTINCT abstract AS 'eje_id' from enrolled WHERE abstract > 0 ORDER BY abstract ASC");
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}
	protected function registradosGetAllByEje($eje){
		$sql=sprintf("SELECT id,name AS 'nombre',last_name AS 'apellido',email,dni,cellphone AS 'celular',school AS 'escuela',position AS 'cargo',district AS 'distrito', abstract AS 'eje' FROM enrolled  WHERE payment = 1 AND abstract = %d  AND affiliate = 1 ORDER BY name ASC",$eje);
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}
	protected function registradosGetAllByEjeByComision($params){
		//error_reporting(E_ALL);
		$sql=sprintf("SELECT id,name AS 'nombre',last_name AS 'apellido',email,dni,cellphone AS 'celular',school AS 'escuela',position AS 'cargo',district AS 'distrito', abstract AS 'eje' FROM enrolled  WHERE payment = 1 AND abstract = %d  AND affiliate = 1 ORDER BY id ASC LIMIT %d OFFSET %d",$params[0],$params[1],$params[2]);
		//echo $sql."<br>";
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}
	public function registradosEnFaltaGetAll(){
		error_reporting(E_ALL);
		$sql=sprintf("SELECT  * FROM enrolled  WHERE payment = 0 OR abstract = 0  OR affiliate = 0 ORDER BY id ASC");
		//echo $sql."<br>";
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}
	public function listadoByNameAscGenerate(){
		error_reporting(E_ALL);
		$asistentes=$this->registradosGetAllByNameAsc();
		$objPHPExcel =  new PHPExcel();

		 

		
		 
		$objPHPExcel->getProperties()->setCreator("CAMYP WEB ADMIN")
									 ->setLastModifiedBy("CAMYP WEB ADMIN")
									 ->setTitle("Reporte asistentes")
									 ->setSubject("Reporte asistentes")
									 ->setDescription("Reporte Asistentes por codigo");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
		                     ->setCellValueByColumnAndRow(0, 2, "PLANILLA DE INSCRIPCIÓN DEL 8º CONGRESO EDUCATIVO CAMYP EL DESAFIO DE LA RELEVANCIA EN EL HACER EDUCATIVO -2016")
							 ->mergeCells('A2:L3')
							 ->mergeCells('A4:B4')
							 ->setCellValueByColumnAndRow(0, 4,"COM. Nº:")
							  ->mergeCells('C4:G4')
							  ->setCellValueByColumnAndRow(2, 4,"TUTOR:")
							  ->mergeCells('H4:L4')
							  ->setCellValueByColumnAndRow(7, 4,"COLABORADORA:")
							  ->setCellValue('A5', ' ')
							  ->setCellValue('B5', 'Código')
							  ->setCellValue('C5', 'Apellido Y Nombre')
							  ->setCellValue('D5', 'DNI')
							  ->setCellValue('E5', 'CEL')
							  ->setCellValue('F5', 'EMAIL')
							  ->setCellValue('G5', 'ESC/DE')
							  ->setCellValue('H5', '1º FECHA')
							  ->setCellValue('I5', '2º FECHA')
							  ->setCellValue('J5', 'Ponencia')
							  ->setCellValue('K5', 'Firma retiro aval')
							  ->setCellValue('L5', 'Fecha');
							  



							
							 
		 $i = 6;
		 $cant=1;
			foreach ($asistentes as $asistente) {
			


				$objPHPExcel->getActiveSheet()
							 ->setCellValue('A'.$i, $cant)
							 ->setCellValue('B'.$i, $asistente->id)
							 ->setCellValue('C'.$i, $asistente->apellido.', '.$asistente->nombre )
							 ->setCellValue('D'.$i, $asistente->dni)
							 ->setCellValue('E'.$i, $asistente->celular)
							 ->setCellValue('F'.$i, $asistente->email)
							 ->setCellValue('G'.$i, $asistente->escuela);

							 if($asistente->fcomicion == "Viernes 21 de Octubre"){
								$objPHPExcel->getActiveSheet()->setCellValue('H'. $i,"X");
							  }else if($asistente->fcomicion == "Sabado 22 de Octubre")
							  {
							 	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i,"X");
							 }
							
				$i++;
				$cant++;
			}


			/*begin style  */

          $center = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );

        $left = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		        )
		    );
  
      $border = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

    $i=$i-1;
	$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($center);
	$objPHPExcel->getActiveSheet()->getStyle('A2:L'.$i)->applyFromArray($border);
	$objPHPExcel->getActiveSheet()->getStyle('A5:L5')->applyFromArray($center);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("40");
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("10");
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("15");
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth("45");
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("40");
	$objPHPExcel->getActiveSheet()->getColumnDimension('k')->setWidth("20");
	$objPHPExcel->getActiveSheet()->getStyle('E6:E'.$i)->applyFromArray($left);
	$objPHPExcel->getActiveSheet()->getStyle('D6:D'.$i)->applyFromArray($left);									;
          			  

  		/*end style table*/









		//Fin loop
		$filePath='reports/listado-por-nombre.xlsx';
		$objPHPExcel->getActiveSheet()->setTitle('Asistentes Por Codigo Asc');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($filePath);
		return $filePath;
	}
	public function listadoByCodeGenerate(){
		error_reporting(E_ALL);
		$asistentes=$this->registradosGetAllByCode();
		$objPHPExcel =  new PHPExcel();
		 
		$objPHPExcel->getProperties()->setCreator("CAMYP WEB ADMIN")
									 ->setLastModifiedBy("CAMYP WEB ADMIN")
									 ->setTitle("Reporte asistentes")
									 ->setSubject("Reporte asistentes")
									 ->setDescription("Reporte Asistentes Alfabeticamente");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
							 ->setCellValue('A1', 'CODIGO')
							 ->setCellValue('B1', 'APELLIDO, NOMBRE' )
							 ->setCellValue('C1', 'EMAIL')
							 ->setCellValue('D1', 'DNI')
							 ->setCellValue('E1', 'CELULAR')
							 ->setCellValue('F1', 'ESCUELA')
							 ->setCellValue('G1', 'CARGO')
							 ->setCellValue('H1', 'DISTRITO ESCOLAR');
		 $i = 3;
			foreach ($asistentes as $asistente) {
			
				$objPHPExcel->getActiveSheet()
							 ->setCellValue('A'.$i, $asistente->id)
							 ->setCellValue('B'.$i, $asistente->apellido.', '.$asistente->nombre )
							 ->setCellValue('C'.$i, $asistente->email)
							 ->setCellValue('D'.$i, $asistente->dni)
							 ->setCellValue('E'.$i, $asistente->celular)
							 ->setCellValue('F'.$i, $asistente->escuela)
							 ->setCellValue('G'.$i, $asistente->cargo)
							 ->setCellValue('H'.$i, $asistente->distrito);
				$i++;
			}
		//Fin loop
		$filePath = 'reports/listado-por-codigo.xlsx';
		$objPHPExcel->getActiveSheet()->setTitle('Asistentes Por Ord Alf');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($filePath);
		return $filePath;
	}
	public function listadoByEjeGenerate(){
		$j=0;
		$ejes = $this->ejesGetAll();
		$asistentes = $this->registradosGetAllByNameAsc();
		$objPHPExcel =  new PHPExcel();
		 
		$objPHPExcel->getProperties()->setCreator("CAMYP WEB ADMIN")
									 ->setLastModifiedBy("CAMYP WEB ADMIN")
									 ->setTitle("Reporte asistentes")
									 ->setSubject("Reporte asistentes")
									 ->setDescription("Reporte Asistentes por Eje");
		foreach($ejes as $eje){ //traes la cantidad de ejes que hay SELECT distinct de abstract en los asistentes. 
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($j);
			$objPHPExcel->getActiveSheet()
							 ->setCellValue('A1', 'CODIGO')
							 ->setCellValue('B1', 'APELLIDO, NOMBRE' )
							 ->setCellValue('C1', 'EMAIL')
							 ->setCellValue('D1', 'DNI')
							 ->setCellValue('E1', 'CELULAR')
							 ->setCellValue('F1', 'ESCUELA')
							 ->setCellValue('G1', 'CARGO')
							 ->setCellValue('H1', 'DISTRITO ESCOLAR');
			$i = 3;
			foreach($asistentes as $asistente){
				if($asistente->eje==$eje->eje_id){
					$objPHPExcel->getActiveSheet()
							 ->setCellValue('A'.$i, $asistente->id)
							 ->setCellValue('B'.$i, $asistente->apellido.', '.$asistente->nombre )
							 ->setCellValue('C'.$i, $asistente->email)
							 ->setCellValue('D'.$i, $asistente->dni)
							 ->setCellValue('E'.$i, $asistente->celular)
							 ->setCellValue('F'.$i, $asistente->escuela)
							 ->setCellValue('G'.$i, $asistente->cargo)
							 ->setCellValue('H'.$i, $asistente->distrito);
					$i++;
				}
			}
			$objPHPExcel->getActiveSheet()->setTitle('Eje '.$eje->eje_id); // id de la sheet
			$j++;
		}
		$filePath = 'reports/listado-por-eje.xlsx';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($filePath);
		return $filePath;
	}


	protected function registradosGetAllByFechaComicion($params){
		$sql="SELECT * FROM enrolled  WHERE fcomicion='{$params[0]}'   ORDER BY last_name ASC LIMIT {$params[1]}";
		$this->MySQL->setQuery($sql);
		$result = $this->MySQL->loadObjectList();
		return $result;
	}


	public function listadoByEjeByComisionGenerate($maxAsistentesComision=500){
		//$ejes = $this->ejesGetAll();
		$fcomicion = array('Viernes 21 de Octubre','Sabado 22 de Octubre');
		//var_dump($fcomicion);die();
		$k=0;
		$e=0;
		$objPHPExcel =  new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("CAMYP WEB ADMIN")
									 ->setLastModifiedBy("CAMYP WEB ADMIN")
									 ->setTitle("Reporte asistentes")
									 ->setSubject("Reporte asistentes")
									 ->setDescription("Reporte Asistentes por Eje por Comision");
		foreach($fcomicion as $key=>$fecha){
			//traes la cantidad de ejes que hay SELECT distinct de abstract en los asistentes. 
			//$asistentes = $this->registradosGetAllByEje($eje->eje_id); // asistentes por EJE
			//$asistentes = $this->registradosGetAllByFechaComicion($fecha[$key],); // asistentes por EJE
			//$totalComisiones = ceil(count($asistentes)/$maxAsistentesComision); //total de comisiones que vamos a tener por ese eje
			//echo 'total comisiones eje'.$eje->eje_id.' '.$totalComisiones;
			//for($comision=1;$comision<=$totalComisiones;$comision++){
				//echo 'Comision nro '.$comision.'<br>';
				
				$params[0]=$fecha;
				//echo 'Eje nro '.$params[0].'<br>';
				$params[1]=$maxAsistentesComision;
				$asistentes =$this->registradosGetAllByFechaComicion($params);
				if($asistentes!=null){//verifica que exista los asistente en determinada fecha//

			 /*begin header to excel*/		
		$objPHPExcel->setActiveSheetIndex($key);
		$objPHPExcel->getActiveSheet()
							->setTitle($fecha)
		                     ->setCellValueByColumnAndRow(0, 2, "PLANILLA DE INSCRIPCIÓN DEL 8º CONGRESO EDUCATIVO CAMYP EL DESAFIO DE LA RELEVANCIA EN EL HACER EDUCATIVO -2016")
							 ->mergeCells('A2:K3')
							 ->mergeCells('A4:B4')
							 ->setCellValueByColumnAndRow(0, 4,"COM. Nº:")
							  ->mergeCells('C4:G4')
							  ->setCellValueByColumnAndRow(2, 4,"TUTOR:")
							  ->mergeCells('H4:K4')
							  ->setCellValueByColumnAndRow(6, 4,"COLABORADORA:")
							  ->setCellValue('A5', ' ')
							  ->setCellValue('B5', 'Código')
							  ->setCellValue('C5', 'Apellido Y Nombre')
							  ->setCellValue('D5', 'DNI')
							  ->setCellValue('E5', 'CEL')
							  ->setCellValue('F5', 'EMAIL')
							  ->setCellValue('G5', 'ESC/DE')
							  ->setCellValue('I5', 'Ponencia')
							  ->setCellValue('J5', 'Firma retiro aval')
							  ->setCellValue('K5', 'Fecha');
							  
              
			 /*end  header to excel*/		
               
             /*begin set values to excel for page*/    
		 $i = 6;
		 $cant=1;
			foreach ($asistentes as $asistente) {
			
				$objPHPExcel->getActiveSheet()
							 ->setCellValue('A'.$i, $cant)
							 ->setCellValue('B'.$i, $asistente->id)
							 ->setCellValue('C'.$i, $asistente->last_name.', '.$asistente->name )
							 ->setCellValue('D'.$i, $asistente->dni)
							 ->setCellValue('E'.$i, $asistente->cellphone)
							 ->setCellValue('F'.$i, $asistente->email)
							 ->setCellValue('G'.$i, $asistente->school);

							 if($asistente->fcomicion == "Viernes 21 de Octubre"){
								$objPHPExcel->getActiveSheet()
											->setCellValue('H5', '1º FECHA')
								            ->setCellValue('H'. $i,"X");
							  }else if($asistente->fcomicion == "Sabado 22 de Octubre")
							  {
							   $objPHPExcel ->getActiveSheet()
							   				->setCellValue('H5', '2º FECHA')
							                ->setCellValue('H'.$i,"X");
							 }
							
				$i++;
				$cant++;
			}
            
			
            /*end set values to excel*/ 
					//echo 'Asitente nro '.$aCom.' de la comision '.$comision.'<br>';

            			/*begin style  */

						          $center = array(
								        'alignment' => array(
								            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								        )
								    );

						        $left = array(
								        'alignment' => array(
								            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
								        )
								    );
						  
						      $border = array(
						  'borders' => array(
						    'allborders' => array(
						      'style' => PHPExcel_Style_Border::BORDER_THIN
						    )
						  )
						);

						    $i=$i-1;
							$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($center);
							$objPHPExcel->getActiveSheet()->getStyle('A2:K'.$i)->applyFromArray($border);
							$objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($center);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("40");
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("10");
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("15");
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth("45");
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("40");
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth("20");
							$objPHPExcel->getActiveSheet()->getStyle('E6:E'.$i)->applyFromArray($left);
							$objPHPExcel->getActiveSheet()->getStyle('D6:D'.$i)->applyFromArray($left);									;
						          			  

  		       /*end style table*/



				$objPHPExcel->createSheet();		
			}
		}



		
		$filePath='reports/listado-por-eje-por-comision.xlsx';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($filePath);
		return $filePath;
	}	
}
?>
