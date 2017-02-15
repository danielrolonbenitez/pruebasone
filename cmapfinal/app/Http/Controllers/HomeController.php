<?php namespace App\Http\Controllers;
use DB;
use Request;
use Redirect;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Library\Thumb;

class HomeController extends Controller {

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
		$provincias=DB::select("SELECT * FROM provincias");
		$rubros=DB::select("SELECT * FROM rubros order by nombre");
    $data= $this->AllLoadNegocios();
    
    $fotosFiltros=DB::select("select  *,provincias.nombre as pnombre,ciudades.nombre as cnombre from fotos
                              join negocios on negocios.idNegocio=fotos.idNegocioF 
                              join provincias on  negocios.idProvinciaF=provincias.idProvincia
                              join ciudades on negocios.idCiudadF=ciudades.idCiudad 
                              where  status <> 'active' group by idNegocioF  order by rand()  limit 20");

		return view('Home.home',compact('provincias','rubros','data','fotosFiltros'));
	}



 public function dataHome()
 {

    $provinciasC=Request::get('provincia');
    $ciudadesC=Request::get('ciudad');
    $rubrosC=Request::get('rubro');
    $clave=Request::get('clave');
    $camara=Request::get('camara');
    $provinciaL=DB::select("select * from provincias");
    $ciudadL=DB::select("select * from ciudades where idProvinciaF='{$provinciasC}'");
    $rubroL=DB::select("select * from rubros order by nombre");
  return view('Home.homeViewNegocioMap',compact('provinciasC','ciudadesC','rubrosC','fotos','provinciaL','ciudadL','rubroL','clave','fotosFiltros','camara'));



 }

public function ajaxLoadFotos()
{
  
 /*selecciona todas las fotos al rubro que pertenece para filtrar el carrousel*/

   $idRubro=(Request::get('idRubro')>0 )? Request::get('idRubro') : 0;
   $idProvincia=(Request::get('idProvincia')>0 )? Request::get('idProvincia') : 0;
   $idCiudad=(Request::get('idCiudad')>0 )? Request::get('idCiudad') : 0;
  
 
//dd($idRubro);



  if($idRubro !==0){


         $sql="select * from negocios_rubros as nr join negocios as n on nr.idNegocioF=n.idNegocio"; 


         if($idProvincia !==0 and $idCiudad !==0 ){

            $sql.="where  nr.idRubroF='{$idRubro}'
                          and n.idProvinciaF='{$idProvincia}'
                          and n.idCiudadF='{$idCiudad}'
                          group By nr.idNegocioF";

         }



                                         else{ 
                                          $sql.="where  nr.idRubroF='{$idRubro}' 
                                                group By nr.idNegocioF";

                                      }




 $NegocioNombreFoto=DB::select($sql);


          foreach($NegocioNombreFoto as $negocioFoto)
          {
              $fotosFiltros=DB::select("select * ,provincias.nombre as pnombre,ciudades.nombre as cnombre  from fotos join negocios on negocios.idNegocio=fotos.idNegocioF join provincias on  negocios.idProvinciaF=provincias.idProvincia join ciudades on negocios.idCiudadF=ciudades.idCiudad  where idNegocioF='{$negocioFoto->idNegocioF}' and status <> 'active' order by rand() limit 10");//
            
            }
         
        $returnHTML=view('includes.carrousel',compact('fotosFiltros'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
       // dd($bandera);
     
         

      }else {//si no hubo  resultados o no se filtro se envian fotos por default///*/
      
    
      $fotosFiltros=DB::select("select *,provincias.nombre as pnombre,ciudades.nombre as cnombre  from fotos join negocios on negocios.idNegocio=fotos.idNegocioF join provincias on  negocios.idProvinciaF=provincias.idProvincia join ciudades on negocios.idCiudadF=ciudades.idCiudad  where  status <> 'active'  order by rand()  limit 10");
      $returnHTML=view('includes.carrousel',compact('fotosFiltros'))->render();
      return response()->json(array('success' => true, 'html'=>$returnHTML));

       

  
      }

    



}






public function MarkeMap()
{
    $prov  = (Request::get('prov') > 0) ? Request::get('prov') : false;
    $ciu   = (Request::get('ciu') > 0) ? Request::get('ciu') : false;
    $rub   = (Request::get('rub') > 0) ? Request::get('rub') : false; 
    $clave = (Request::get('clav')) ? Request::get('clav') : false;
    $camara= (Request::get('camara'))  ? Request::get('camara') : false;


  $data=DB::table('negocios as n')
                  ->select('*','p.nombre AS p_nombre','r.nombre AS rubro_nombre','c.nombre AS ciudad_nombre')                
                  ->join('provincias as p','n.idProvinciaF','=','p.idProvincia')
                  ->join('ciudades as c','n.idCiudadF','=','c.idCiudad')
                  ->join('fotos as f','n.idNegocio','=','f.idNegocioF')
                  ->join('negocios_rubros as nr','n.idNegocio','=','nr.idNegocioF')
                  ->join('rubros as r','nr.idRubroF','=','r.idRubro')
                  ->leftjoin('entidades as e','n.idEntidadF','=','e.idEntidad')
                  ->where('f.status','=','active')
                  ->groupBy('n.idNegocio');
           
                  if($prov)
                  {
                    $data->where('n.idProvinciaF', '=', $prov);
                          
                  };

                  if($ciu)
                  {
                    $data->where('n.idCiudadF','=',$ciu);
                          
                  };

                  if($rub)
                  {
                    $data->where('r.idRubro', '=',$rub);
                          
                  };

                  if($clave)
                  {
                    $data->where('n.razonSocial','LIKE','%'.$clave.'%');
                        
                  };


                  if($camara)
                  {
                    $data->where('e.nombre','LIKE','%'.$camara.'%');
                        
                  };
                  
                  
                 

                  $data=$this->agregaRubos($data->get());  


return $data;


}//end function






public function agregaRubos($data){

//trae todos los rubros a los que pertenece el negocio//
 $acum2="";

foreach ($data AS  $key=>$rubro) {
                                  $result=DB::select("SELECT * FROM negocios_rubros AS nr INNER JOIN rubros AS r 
                                                       ON nr.idRubroF=r.idRubro WHERE nr.idNegocioF={$rubro->idNegocioF}");
        
                                  $rubro->rubro_nombre="";

                                      foreach ($result AS $key => $value) {
                                                                            $acum=$value->nombre;
                                                                            $rubro->rubro_nombre.=$acum.' ';
                                                                                //array_push($data,"hello");

                                                                          }

                                  }

return $data;

}














public function AllLoadNegocios(){

                                                        
 $data=DB::table('negocios as n')->
                  join('provincias as p','n.idProvinciaF','=','p.idProvincia')->
                  join('ciudades as c','n.idCiudadF','=','c.idCiudad')->
                  join('fotos as f','n.idNegocio','=','f.idNegocioF')->
                  join('negocios_rubros as nr','n.idNegocio','=','nr.idNegocioF')->
                  join('rubros as r','nr.idRubroF','=','r.idRubro')->
                  select('*','p.nombre AS p_nombre','r.nombre AS rubro_nombre','c.nombre AS ciudad_nombre')->
                  where('f.status','=','active')->
                  groupBy('n.idNegocio')->
                  get();
                                                                                                                                                                                      

 //dd($data);                                                                                                                                                                               
                                                                                                                                                                                          
$data=$this->agregaRubos($data); 

$data=Collection::make($data);
$data=$this->createManualPaginator($data);
return $data;
}



 private function createManualPaginator($collection, $perPage = 3)
   {
       //Get current page form url e.g. &page=6
       $currentPage = LengthAwarePaginator::resolveCurrentPage();

       //Slice the collection to get the items to display in current page
       $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

       //Create our paginator and  ASs it to the view
       $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
       $paginatedSearchResults->setPath(url('/prueba'));

       return $paginatedSearchResults;
   }



//envia nombre de camara//

   public function camara()
   {
  
     $camarasNombres=DB::select("select nombre from entidades");


     foreach ($camarasNombres as $camara) {

      $camaras[]=$camara->nombre;
     }


   return  $camaras;
             
   

   } 























}//end class
