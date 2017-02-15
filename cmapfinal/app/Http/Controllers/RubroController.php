<?php namespace App\Http\Controllers;

use Hash;
use Auth;
use Input;
use App\User;
use App\Negocio;
use App\Fotos;
use App\Rubro;
use Redirect;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;


class RubroController extends Controller {

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

      $rubros=Rubro::paginate('10');
      $rubros->setPath('Rubro');

     
      return view('Rubro.indexRubro',compact('rubros'));


}


public  function store(Request $request){
  
 
 $rules = array(
        'nombre'=>'required|unique:rubros',
        'color'=>'required',
        
    );


	  $messsages = array(
       'nombre.required'=>'Debe Ingresar El nombre de un rubro',
       'nombre.unique'=>' El nombre del rubro ya Existe',
       'color.required'=>'Debe selecionar un color',

       
    );

 $validator = Validator::make(Input::all(),$rules,$messsages);


if ($validator->fails()) {
            return Redirect::to('/AltaRubro')->withErrors($validator);


}






      $rubro=new Rubro();
      $rubro->nombre=ucwords(Input::get('nombre'));
      $rubro->color=(Input::get('color'));
      $rubro->save();
	 return Redirect::route('indexRubro')->withFlashMessage('El Rubro Se Creo Correctamente.');
	
	
}


public  function rubroEdit($id){


$datos =DB::select("select * from rubros where idRubro={$id}");


return view('Rubro.editRubro')->with('datos',$datos);
	
}

public  function rubroEditStore(){
try{
	$idRubro=Input::get('idRubro');
	$nombre=Input::get('nombre');
	$color=Input::get('color');
   
	DB::table('rubros')
	            ->where('idRubro', $idRubro)
	            ->update(array('nombre' => $nombre,'color'=>$color));
	return Redirect::route('indexRubro')->withFlashMessage('El Rubro Se a Editado Correctamente');
	}catch(Exception $e){

		return Redirect::route('rubroEdit',$idRubro)->withFlashMessage('El Rubro Ya Existe !!Ingrese Otro Nombre!!');
	}
	









}








public  function deleteRubro($id){

DB::table('rubros')->where('idRubro', '=', $id)->delete();

return Redirect::route('indexRubro')->withFlashMessage('Rubro Se a Eliminado.');
}








}//end controller