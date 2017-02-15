<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use Session;
use Auth;
use Exception;
use Validator;
use Input;


class AdminController extends Controller {

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
   return view('Admin.loginIndex');
	}



   public function validaUser()
   {
    $email = Request::input('email');
    $password = Request::input('password');

	
			  if (Auth::attempt(array('email' => $email, 'password' => $password)))
        {            
            return redirect::route('panel');
                        
 
		}else {  return Redirect::route('login')->withFlashMessage('Usuario Icorrecto');}

   }

    


   public function panel()
   {
   	 $anio=$this::getAnio();
     $cantInscripto=DB::select("select count(idCursoInscripto) as cantidad from vns_cursos_inscriptos");
     return view('Admin.panel',compact('anio','cantInscripto'));
   }


 public function plantillaExcel()
 {

//debido a que en la tabla cursos_isncripto se guardan todos los peridos  hacemos una consulta para obrener el id del ultimo periodo//
 
 
    $anio=Request::get('anio');
    $periodoNombre=Request::get('periodoNombre');


$data=DB::select("select * from vns_cursos_inscriptos as c 
                 left join vns_periodos as p  on  c.idPeriodoF=p.idPeriodo 
                 left join vns_cursos on vns_cursos.idCurso=p.idCursoF
                 left join wp_pc_users on c.idUserInscripto=wp_pc_users.id
                 where c.periodoNombre='{$periodoNombre}' and  c.created_at like '%{$anio}%' order by p.fecha asc");


//dd($data);

if(count($data)>0){
return view('Admin.plantillaExcel')->with('data',$data);
 
 }else{return Redirect::route('panel')->withFlashMessage('No Hay Ningun Inscripto Para Descargar En Este Año y Periodo!!');}



 

 }//end function









public function getAnio()
{


$anioObj=DB::select("select fecha from vns_periodos group by periodoNombre");


foreach ($anioObj as $anio) {

$fecha=$anio->fecha;
$fecha=explode('-',$fecha);

$anioArray[]=$fecha[0];

}


$anioArray=array_unique($anioArray);



if(count($anioArray)>0)

	{return $anioArray;}else{return "false";}






}//end function getAnio


public function ajaxAnioPeriodo()
{

  $anio=Request::get('anio');
  
  ///dd($anio);
  $periodos=DB::select("Select distinct(c.periodoNombre) from vns_cursos_inscriptos as c left join vns_periodos as p on c.idPeriodoF=p.idPeriodo where c.created_at like '%{$anio}%'");


return $periodos;

}




public function ajaxVerPorPantalla()
{
  $anio=Request::get('anio');
  $periodoNombre=Request::get('periodoNombre');



$data=DB::select("select * from vns_cursos_inscriptos as c
                  left join vns_periodos as p  on  c.idPeriodoF=p.idPeriodo 
                  left join vns_cursos on vns_cursos.idCurso=p.idCursoF
                  left join wp_pc_users on c.idUserInscripto=wp_pc_users.id
                  where c.periodoNombre='{$periodoNombre}' and  c.created_at like '%{$anio}%' order by p.fecha asc");

//dd($data);die();

$returnHTML=view('Admin.verPorPantalla')->with('data',$data)->render();


return response()->json(array('success' => true, 'html'=>$returnHTML));

}





public function cursoalta(){


 if(Request::isMethod('post')){

$rules = array(
        'nombre'=>'required',   
    );
$messages = array(
       'nombre.required'=>'Debe Ingresar el Nombre Del Curso',
       

       
    );
$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('cursoAlta')->withErrors($validator);}


  $nombre=Request::get('nombre');
  $desCorto=Request::get('desCorto');
  $descripcion=Request::get('descripcion');
  $tipo=Request::get('tipo');

DB::table('vns_cursos')->insert(
    ['nombre' => $nombre, 'desCorto' => $desCorto ,'descripcion'=>$descripcion,'tipo'=>$tipo]
);

return Redirect::route('cursoIndex')->withFlashMessage('El Curso Se Creo Correctamente.');

}






return view('Admin.cursoalta');
}




public function periodoalta(){


 if(Request::isMethod('post')){

$rules = array(
        'nombrePeriodo'=>'required',
        'destinado'=>'required',
        'curso'=>'required',
        'capacitador'=>'required', 
        'fecha' =>'required' 
    );
$messages = array(
       'nombrePeriodo.required'=>'Debe Ingresar el Nombre Del Periodo',
       'destinado.required'=>'Debe Ingresar el Nombre, a quien se dirije el curso',
       'curso.required'=>'Debe seleccionar un curso',
       'capacitador.required'=>'Debe Ingresar el Nombre Del Capacitador del curso',
       'fecha.required'=>'Debe Ingresar la fecha en que se realizara el curso',
       

       
    );
$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('periodoAlta')->withErrors($validator);}


  $nombrePeriodo=Request::get('nombrePeriodo');
  $destinado=Request::get('destinado');
  $curso=Request::get('curso');
  $capacitador=Request::get('capacitador');
  $fecha=Request::get('fecha');

DB::table('vns_periodos')->insert(
    ['periodoNombre' => $nombrePeriodo, 'destinado' => $destinado ,'idCursoF'=>$curso,'capacitador'=>$capacitador,'fecha'=>$fecha]
);

return Redirect::route('periodoIndex')->withFlashMessage('El Periodo Se Creo Correctamente.');

}
$cursos=DB::select("select * from vns_cursos where tipo <>'campus'");
$capacitadores=DB::table("vns_capacitador")->get();
$destinatarios=DB::table("vns_destinatarios")->get();
//dd($destinatarios);
return view('Admin.periodoalta',compact('cursos','capacitadores','destinatarios'));


}





public function  cursoindex()
{
  if(Request::isMethod('post')){
           $search=trim(Request::get('busqueda'));
           $cursos=DB::table('vns_cursos')->where('nombre','like',$search.'%')->paginate(3);
           $cursos->setPath('curso_index');
          if(count($cursos)>0){
             return view('Admin.cursoindex',compact('cursos'));
           }else{

            return back()->withFlashMessage('No se encotro resultado');
           }

   }

$cursos=DB::table('vns_cursos')->paginate(10);
$cursos->setPath('curso_index');
return view('Admin.cursoindex',compact('cursos'));


}

public  function cursodelete($id){

DB::table('vns_cursos')->where('idCurso', '=', $id)->delete();

return Redirect::route('cursoIndex')->withFlashMessage('El Curso  Se a Eliminado.');
}

public function cursoedit($id){



 if(Request::isMethod('post')){

$rules = array(
        'nombre'=>'required',   
    );
$messages = array(
       'nombre.required'=>'Debe Ingresar el Nombre Del Curso',
       

       
    );
$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('cursoEdit')->withErrors($validator);}

  $id=Request::get('id');
  $nombre=Request::get('nombre');
  $desCorto=Request::get('desCorto');
  $descripcion=Request::get('descripcion');
  $tipo=Request::get('tipo');

DB::table('vns_cursos')->where('idCurso','=',$id)
                       ->update(['nombre' => $nombre, 'desCorto' => $desCorto ,'descripcion'=>$descripcion,'tipo'=>$tipo]);


return Redirect::route('cursoIndex')->withFlashMessage('El Curso  Se Edito Correctamente.');
}

$curso=DB::table('vns_cursos')->where('idCurso','=',$id)->get();
$tipo=["ninguno","campus"];
return view('Admin.cursoedit',compact('curso','tipo'));
}






public function  periodoindex()
{

$anio=date('Y-m-d');
$anio=explode('-',$anio);
$anio=$anio[0];
$periodos=DB::table('vns_periodos')->where('fecha','like','%'.$anio.'%')->orderBy('fecha','desc')->paginate(10);
$periodos->setPath('periodo_index');
return view('Admin.periodoindex',compact('periodos','anio'));
}



public  function periododelete($id){

DB::table('vns_periodos')->where('idPeriodo', '=', $id)->delete();

return Redirect::route('periodoIndex')->withFlashMessage('El Periodo  Se a Eliminado.');
}

public function periodoEdit($id){

if(Request::isMethod('post')){

$rules = array(
        'nombrePeriodo'=>'required',
        'destinado'=>'required',
        'curso'=>'required',
        'capacitador'=>'required',
        'fecha'=>'required'

    );
$messages = array(
       'nombrePeriodo.required'=>'Debe Ingresar el Nombre Del Periodo',
       'destinado.required'=>'Debe ingresar a quien va dirijido el curso',
       'curso.required'=>'Debe seleccionar un curso',
       'capacitador.required'=>'Debe ingresar el nombre de un capacitador',
       'fecha.required'=>'Debe Ingresar la fecha en la que se dicta el curso',
       

       
    );
$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('cursoEdit')->withErrors($validator);}

  $id=Request::get('id');
  $nombrePeriodo=Request::get('nombrePeriodo');
  $destinado=Request::get('destinado');
  $curso=Request::get('curso');
  $capacitador=Request::get('capacitador');
  $fecha=Request::get('fecha');

DB::table('vns_periodos')->where('idPeriodo','=',$id)
                       ->update(['periodoNombre' => $nombrePeriodo, 'destinado' => $destinado ,'idCursoF'=>$curso,'capacitador'=>$capacitador,'fecha'=>$fecha]);


return Redirect::route('periodoIndex')->withFlashMessage('El Periodo  Se Edito Correctamente.');
}






$periodo=DB::table('vns_periodos')->where('idPeriodo','=',$id)->get();
$cursos=DB::table('vns_cursos')->get();
$capacitadores=DB::table("vns_capacitador")->get();
$destinatarios=DB::table("vns_destinatarios")->get();

return view('Admin.periodoedit',compact('periodo','cursos','capacitadores','destinatarios'));
}


/*agregar nuevas categorias*/
public function  tablaWPtermsindex()
{
$wpterms=DB::table('wp_terms')->paginate(10);
$wpterms->setPath('tablaWpterms_index');

  
$data=DB::table('wp_terms')
        ->leftjoin('vns_wp_pins','term_id','=','idCat')
        ->leftjoin('vns_log_wp_terms','term_id','=','id_terms')
        ->whereNotIn('term_id', function($q){
         $q->select('idCat')->from('vns_wp_pins');
         })
         ->whereNotIn('term_id', function($q){
         $q->select('id_terms')->from('vns_log_wp_terms');  
         })->get();

return view('Admin.tablawptermsindex',compact('wpterms','data'));
}



public function  categoriaindex()
{
$categoria=DB::table('vns_wp_pins')->paginate(10);
$categoria->setPath('categoria_index');
return view('Admin.categoriaindex',compact('categoria'));
}




public function categoriaalta(){
 if(Request::isMethod('post')){

$rules = array(
        'idCat'=>'required', 
        'pinName'=>'required',     
    );
$messages = array(
       'idCat.required'=>'Debe Ingresar  el id categoria(ver term_id de wp_terms)',
       'pinName.required'=>'Debe Ingresar el nombre de la categoria',
       'grupo_id.required'=>'Debe Ingresar el grupo  de la categoria',    
    );

$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('categoriaAlta')->withErrors($validator);}
  $idCat=Request::get('idCat');
  $pinName=Request::get('pinName');
  $grupo_id=Request::get('grupo_id');
  $puede_inscribir=Request::get('puede_inscribir');

DB::table('vns_wp_pins')->insert(
    ['idCat' => $idCat, 'pinName' => $pinName ,'grupo_id'=>$grupo_id,'puede_inscribir'=>$puede_inscribir]
);
return Redirect::route('categoriaIndex')->withFlashMessage('La Categoria Se Creo Correctamente.');
}
return view('Admin.categoriaalta');
}



public  function categoriadelete($id){
DB::table('vns_wp_pins')->where('id', '=', $id)->delete();
return Redirect::route('categoriaIndex')->withFlashMessage('la Categoria  Se a Eliminado.');
}




public function categoriaedit($id){

 if(Request::isMethod('post')){
$rules = array(
        'idCat'=>'required',
        'pinName'=>'required',
        'grupo_id'=>'required',

    );
$messages = array(
       'idCat.required'=>'Debe Ingresar elid de la  Categoria',
       'pinName.required'=>'Debe Ingresar el nombre de la categoria',
       'grupo_id.required'=>'Debe Ingresar el id grupo de la categoria');

$validator = Validator::make(Input::all(),$rules,$messages);

if ($validator->fails()) { return Redirect::route('categoriaEdit')->withErrors($validator);}
  $id=Request::get('id');
  $idCat=Request::get('idCat');
  $pinName=Request::get('pinName');
  $grupo_id=Request::get('grupo_id');
  $puede_inscribir=Request::get('puede_inscribir');
DB::table('vns_wp_pins')->where('id','=',$id)
                       ->update(['idCat' => $idCat, 'pinName' => $pinName,'grupo_id'=>$grupo_id,'puede_inscribir'=>$puede_inscribir]);

return Redirect::route('categoriaIndex')->withFlashMessage('La categoria  Se Edito Correctamente.');
}

$categoria=DB::table('vns_wp_pins')->where('id','=',$id)->get();
return view('Admin.categoriaedit',compact('categoria'));
}


public  function wplogDelete($id,$name){

DB::table('vns_log_wp_terms')->insert(['id_terms'=>$id,'name_log'=>$name,'accion'=>'delete']);
return Redirect::route('tablaWPtermsIndex')->withFlashMessage('Se a Elimino el registro.');
}

/*end agregar nuevas categorias*/

/*cross table data machea los datos de wp_terms con los de vns_wp_pins*/ 
public function crossTableData($id,$name,$accion){

/*if($accion=='update'){
 
 /*actuliza si tiene id de categoria*/
 /*DB::table('vns_wp_pins')->where('idCat','=',$idterm)
                            ->update(['pinName' => $name]);

DB::table('vns_log_wp_terms')->where('id_terms','=', $idterm)
                            ->where('accion','=', $accion) 
                            ->delete();                   

}*/
 if($accion='insert'){
 
$grupo_id=Request::get('group_id');
DB::table('vns_wp_pins')->insert(['idCat'=>$id,'pinName'=>$name,'grupo_id'=>$grupo_id]);

}

return Redirect::route('tablaWPtermsIndex')->withFlashMessage('Los Datos se vincularon correctamente');

}


/*table logs*/
public function tablelogIndex(){

$register=DB::table('vns_log_wp_terms')->paginate('10');
$register->setPath('tablelogIndex');

return view('Admin.tablelogindex',compact('register'));

}

public  function logdelete($id){

DB::table('vns_log_wp_terms')->where('id_terms','=',$id)->delete();
return Redirect::route('tablelogIndex')->withFlashMessage('El Registro  Se a Eliminado.');
}





public function usercategories(){

$usuarios=DB::table('wp_pc_users')->get();
$cantidadusuarios=count($usuarios);
$datousuario=$this->cargaDatosUsuarioCategorias($usuarios);
 
 /*funcion search*/
 if(Request::isMethod('post')){
          
          $search=trim(Request::get('busqueda'));
          $usuarios=DB::table('wp_pc_users')->where('username','like',$search.'%')
                                            ->whereOr('email','like',$search.'%')->get();
      
          $datousuario=$this->cargaDatosUsuarioCategorias($usuarios);
          
          if(count($datousuario)>0){
             return view('Admin.usuariocategorias',compact('datousuario','cantidadusuarios'));
           }else{
            return back()->withFlashMessage('No se encotro resultado');
           }

   }

 /*end funcion search*/


return view('Admin.usuariocategorias',compact('datousuario','cantidadusuarios'));


}




public function cargaDatosUsuarioCategorias($usuarios){

if(!empty($usuarios)){

foreach ($usuarios as $key => $usuario) {
         
      
         $categorias=unserialize($usuario->categories);
      
       if(!empty($categorias)){
      
          $categos=DB::table('wp_terms')->select('name')->whereIn('term_id',$categorias)->get();
          foreach($categos as $cate){ 

            $datacategoria[]=$cate->name;
          }
          
         
           $categos=(!empty($datacategoria))?implode(',',$datacategoria):'no valido';

          $datousuario[]=array('id'=>$usuario->id,'name'=>$usuario->name,
                             'surname'=>$usuario->surname,'username'=>$usuario->username,'email'=>$usuario->email,
                             'categorias'=>$categos);
       
      
         $datacategoria='';
       }

    
}

  return  $datousuario;

}


}


/*destinatarios*/

public  function destinatarioindex(){
$destinatarios=DB::table('vns_destinatarios')->get();
return view('Admin.destinatarioindex',compact('destinatarios'));

}

public function destinatarioalta(){

if(Request::isMethod('post')){
$nombre=Request::get('nombre');
DB::table('vns_destinatarios')->insert(['nombre' => $nombre]);
return Redirect::route('destinatarioIndex')->withFlashMessage('El Destinatario Se Creo Correctamente.');
}

return view('Admin.destinatarioalta');
}


public function destinatarioedit($id){
 

  if(Request::isMethod('post')){
    $id=Request::get('id');
    $nombre=Request::get('nombre');
    $rules = array('nombre'=>'required');
    $messages = array('nombre.required'=>'Debe Ingresar el Nombre Del Destinatario');
    $validator = Validator::make(Input::all(),$rules,$messages);
    if ($validator->fails()){ return back()->withErrors($validator);}
    DB::table('vns_destinatarios')->where('idDestinatario','=',$id)
                       ->update(['nombre' => $nombre]);
    return Redirect::route('destinatarioIndex')->withFlashMessage('El Destinatario Se Creo Correctamente.');
  }
    
    $destinatario=DB::table('vns_destinatarios')->where('idDestinatario','=',$id)->get(); 
    return view('Admin.destinatarioedit',compact('destinatario'));

}



public  function destinatariodelete($id){
DB::table('vns_destinatarios')->where('idDestinatario','=',$id)->delete();
return Redirect::route('destinatarioIndex')->withFlashMessage('El Registro  Se a Eliminado.');
}


/*end destinatarios*/




/*capacitador*/

public  function capacitadorindex(){
$capacitador=DB::table('vns_capacitador')->get();
return view('Admin.capacitadorindex',compact('capacitador'));

}

public function capacitadoralta(){

if(Request::isMethod('post')){
$nombre=Request::get('nombre');
DB::table('vns_capacitador')->insert(['nombre' => $nombre]);
return Redirect::route('capacitadorIndex')->withFlashMessage('El capacitador Se Creo Correctamente.');
}

return view('Admin.capacitadoralta');
}


public function capacitadoredit($id){
 

  if(Request::isMethod('post')){
    $id=Request::get('id');
    $nombre=Request::get('nombre');
    $rules = array('nombre'=>'required');
    $messages = array('nombre.required'=>'Debe Ingresar el Nombre Del capacitador');
    $validator = Validator::make(Input::all(),$rules,$messages);
    if ($validator->fails()){ return back()->withErrors($validator);}
    DB::table('vns_capacitador')->where('idCapacitador','=',$id)
                       ->update(['nombre' => $nombre]);
    return Redirect::route('capacitadorIndex')->withFlashMessage('El Capacitador Se Creo Correctamente.');
  }
    
    $capacitador=DB::table('vns_capacitador')->where('idCapacitador','=',$id)->get(); 
    return view('Admin.capacitadoredit',compact('capacitador'));

}



public  function capacitadordelete($id){
DB::table('vns_capacitador')->where('idCapacitador','=',$id)->delete();
return Redirect::route('capacitadorIndex')->withFlashMessage('El Registro  Se a Eliminado.');
}


/*end destinatarios*/


















}//end class