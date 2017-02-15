<?php namespace App\Http\Controllers;

use Hash;
use Auth;
use Request;
use App\User;
use App\Negocio;
use App\Fotos;
use App\Rubro;
use App\Entidad;
use Redirect;
use DB;
use Session;
use Exception;
use Validator;
use Input;

class ExcelController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	

public  function index(){

}


public function download($seleccionado)
{
  

    switch ($seleccionado) {
    	case '1':
                 $rubros=DB::select("select * from rubros");
                 return view('Excel.excelDownloadRubros',compact('rubros'));

			break;

    	case '2':
    		     $entidades=DB::select("select * from entidades");
    		     return view('Excel.excelDownloadEntidades',compact('entidades'));

    		break;

    	case '3':
    			 $data=DB::select("select * ,p.nombre as provinciaNombre,c.nombre as ciudadNombre,e.nombre as entidadNombre from negocios as n 
    			 					join provincias as p on n.idProvinciaF=p.idProvincia
    			 					join ciudades as c  on n.idCiudadF=c.idCiudad
    			 					left join entidades as e  on n.idEntidadF=e.idEntidad

    			 					");


foreach ($data AS  $key=>$rubro) {
                                  $result=DB::select("SELECT * FROM negocios_rubros AS nr INNER JOIN rubros AS r 
                                                       ON nr.idRubroF=r.idRubro WHERE nr.idNegocioF={$rubro->idNegocio}");
        
                                  $rubro->rubro_nombre="";

                                      foreach ($result AS $key => $value) {
                                                                            $acum=$value->nombre;
                                                                            $rubro->rubro_nombre.=$acum.' ';
                                                                                //array_push($data,"hello");

                                                                          }

                                 }
                    




    			 //dd($data);

					










    			 return view('Excel.excelDownloadNegocios',compact('data'));
    		
    		break;
    	
    	default:
    		
    		break;
    }
  












    return($seleccionado);
 
}











}//end controller