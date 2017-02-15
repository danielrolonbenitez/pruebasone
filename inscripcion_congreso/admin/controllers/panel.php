<?php
include('models/exportarModel.php'); //incluyo model exportar;
class Panel {
	private $id;
	private $tipo;
	private $id_tipo;
	private $mainModel;
	private $wday;
	private $months;
	private $user;
	
	function __construct(){
		if(isset($_GET["t"])) $this->tipo = $_GET["t"];
		if(isset($_GET["idt"])) $this->idt = $_GET["idt"];
		if(isset($_GET["id"])) $this->id = $_GET["id"];
		if(!isset($_GET['page'])) $this->page = 1;
		$this->mainModel = new MainModel();
		if(isset($_SESSION['registrado'])) $this->user = $_SESSION['registrado'];
		$this->wday = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
		$this->months = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		
	}

	function index(){
		$seccion = "Bienvenido";
		include("views/header.php");
		include("views/footer.php");
	}
	
	
	function login(){
		$seccion = "Login";
		include("views/login.php");
	}
	
	function inscriptos(){
	
		switch($this->tipo){
			case "abstract":
				$search = array();
				if(isset($_GET['criterio'])){
					if($_GET['criterio'] == 'name' || $_GET['criterio'] == 'last_name') $search[$_GET['criterio']] = " LIKE '%".$_GET['search']."%'";
					if($_GET['criterio'] == 'dni' || $_GET['criterio'] == 'id') $search[$_GET['criterio']] = " = '".preg_replace("/[^0-9]/", "",$_GET['search'])."'";
				}
				
				$registros = $this->mainModel->listarInscriptos($search);				
				$vista = "listado_abstract.php";
				break;
			case "modifica":
				$registro = $this->mainModel->traerInscripto($this->id);				
				$vista = "modifica_inscripto.php";
				break;
			case "general":
			default:
				$registros = $this->mainModel->listarInscriptos();
				$vista = "listado_general.php";
				break;
		}
		include("views/header.php");
		include("views/".$vista);
		include("views/footer.php");
	}
		
	function usr(){
		switch($this->tipo){
			case "dologin":
				$usr = $_POST['user'];
				$pass = $_POST['password'];
				$md5 = md5($pass);
				$sql = "SELECT * FROM admin WHERE password = '$md5' AND user = '$usr'";
				$MySQL = MySQL::getInstance();
				$MySQL->setQuery($sql);
				$MySQL->execute();
				$datosusuario = $MySQL->loadObject();
				$cuenta = $MySQL->getNumRows();
				if($cuenta == 1){
					$_SESSION['registrado'] = array();
					$_SESSION['registrado']['id'] = $datosusuario->id;
					$_SESSION['registrado']['usuario'] = $datosusuario->username;	
					$_SESSION['registrado']['permissions'] = $datosusuario->permissions;				
					header('Location: ?m=listado');				
				}
				else{
					header('Location: ?a=login&err=1');
				}
				break;
			case "logout":
				session_destroy();				
				header('Location: ?m=listado');
				break;
		}
	}
	function exportar($request=''){
		// definiendo model export
		$modelExportar = new exportarModel();
		$request=(object)$_REQUEST;
		if(isset($request->action)){
			switch ($request->action){
			case 'listado-completo-por-codigo':
				//$modelExportar->afiliadosGetAllByCode();
				return print($modelExportar->listadoByCodeGenerate());
			break;
			
			case 'listado-completo-por-nombre':
				return print($modelExportar->listadoByNameAscGenerate());
			break;
			case 'listado-completo-por-eje':
				return print($modelExportar->listadoByEjeGenerate());
			break;
			case 'listado-completo-por-eje-por-comision':
				if(isset($request->cantidad)):
					return print($modelExportar->listadoByEjeByComisionGenerate($request->cantidad));
				else:
					return print($modelExportar->listadoByEjeByComisionGenerate(500));
				endif;
			break;
			case 'ver-asistentes-en-falta':
				$registros=$modelExportar->registradosEnFaltaGetAll();
				include("views/header.php");
				include("views/exportar/ver_asistentes_en_falta.php");
				include("views/footer.php");
			break;
			//in case of no action parameter
			default:
				
			break;		
			}
		}else{
				include("views/header.php");
				include("views/exportar.php");
				include("views/footer.php");
		}
	}

}


?>