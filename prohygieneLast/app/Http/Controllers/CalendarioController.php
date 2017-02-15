<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use calendario;
use Session;
use App\Http\Controller\Admin;

class CalendarioController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{  	
	

          $periodos=DB::select('select * from vns_periodos group by periodoNombre');
		 //obtengo la fecha del ultimo periodo para iniciar el calendario en el ultimo periodo//

          $fechaLastPeriodo=DB::select('select * from vns_periodos group by periodoNombre order by periodoNombre desc limit 1');
 
          $fechaPeriodo=$fechaLastPeriodo[0]->fecha;
          //dd($fecha);

          $anio=new AdminController();

          $anio=$anio->getAnio();

		return view('Calendario.calendarioIndex',compact('periodos','fechaPeriodo','anio'));
	}








   public function r()
   {
      //carga todos los eventos de un determinado periodo a el calendario//

  

     
         

  $cursodescripcions =DB::select("select * from vns_periodos as p join vns_cursos as c  on p.idCursoF=c.idCurso");

     

    



         foreach($cursodescripcions as $curso)
              {
                  $destinadoA=$curso->destinado;
                  $nombreCurso=$curso->nombre;
                  $desCurso=$curso->desCorto;
                  $descripcion=$curso->descripcion;
                  $fecha=$curso->fecha;
                  $color=$this->color($fecha,$curso->periodoNombre);

                  $capacitador=$curso->capacitador;
                  $periodoNombre=$curso->periodoNombre;

                  //dd($capacitador);
                 

                $array2[]=array( "destinadoA"=>$destinadoA,"nombreCurso"=>$nombreCurso,"desCurso"=>$desCurso,"descripcion"=>$descripcion,"fechaI"=>$fecha,"fehcaE"=>$fecha,"capacitador"=>$capacitador,"color"=>$color,"periodoNombre"=>$periodoNombre);//obtiene  el nombre del curso
              }



         



          
           

       $json=$array2;

         //var_dump($json) or die();


      return $json;
















   }


public function color($fecha,$periodoNombre)
{

  $periodoNombre=explode(' ',$periodoNombre);

  $fechaHoy=date('Y-m-d'); 
 //pregunto si la fecha es menor a la de hoy seteo el color//
                    if($fecha<$fechaHoy)
                    {
                       $color='silver';
                    }else if($periodoNombre[1]%2==0){$color='blue';}else{$color='green';}


return $color;
}






public function ajaxAnioPeriodoCalendario(){

 $anio=Request::get('anio');
 $periodos=DB::select("Select distinct(p.periodoNombre) from vns_periodos as p   where EXTRACT(YEAR FROM fecha)='{$anio}' order by periodoNombre desc");
 return $periodos;

}










}//end class








