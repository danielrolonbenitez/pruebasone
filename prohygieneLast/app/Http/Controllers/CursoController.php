<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use Session;
use Exception;
use Input;
use Validator;
use App\Http\Controllers\AdminController;

class CursoController extends Controller {

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
   * Levanta el usuario logueado en WP
   * Guarda en session categorìa usuario logueado
   * Guarda en session categorias para filtrar
   * 
   * @return View
   *
   */


  public function inscripcion()
{    
   
    //obtengo  el dato del usuario que inicia seccion en wordpress y lo guardo en una session//
    session_start();    
    //$idSession=5;
    if(isset($_SESSION['pc_user_id'])){
    $idSession=$_SESSION['pc_user_id'];
    Session::put('idSession', $idSession);
    //obtener  los datos de el  usuario logeado en wordpress de wordpress//
    $idLoginWp=Session::get('idSession');
    $userLoginWp=DB::connection('wordpress')->select("select * from wp_pc_users where id='{$idLoginWp}'");
    //almacena las categorias a las que pertece el que se logea//
    $categoria=DB::connection('wordpress')->select("select categories from wp_pc_users where id='{$idLoginWp}'");
    $categoria=unserialize($categoria[0]->categories);
    $categoria=implode(',',$categoria);
    //obtengo todas los nombres de la categoria que estan mapeada para filtrar//
    $categoriaFiltro=DB::select("select * from vns_wp_pins where idCat IN(".$categoria.")");
   
    $categoArray=[];
    foreach($categoriaFiltro as $key=>$value) {
    
      $categoArray[]=$value->idCat;
    }
   
    /*new function*/
  
    $aux=$categoArray[0];
    
   foreach ($categoArray as $key=>$value){
    
    if($value==233)
    {
      $categoArray[0]=$value;
      $categoArray[$key]=$aux;
    }
   
    

   }
   
   /*end function*/
    //dd($categoArray);
    //guardo en la session todas las categorias que tiene el usuario logeado//
    Session::put('categories',$categoArray);

    //end almacena a las categorias a las que pertenece el que se loguea//

    //obtengo el ultimo periodo//
    $periodoNombre=DB::select("select periodoNombre from vns_periodos order by periodoNombre desc limit 1");
    $periodoNombre=$periodoNombre[0]->periodoNombre;
     //envia el anio //
     $anio=new AdminController();
     $anio=$anio->getAnio();
   //dd($anio);
    //envia los periodos junto con los cursos mayores a la fecha de hoy//
    $fechaHoy=date("Y-m-d");
     //$date=date("Y-m-d",strtotime($date));
     //dd($fechaHoy);
    $periodos=DB::select("select * from vns_periodos join vns_cursos on vns_periodos.idCursoF=vns_cursos.idCurso where periodoNombre='{$periodoNombre}' and fecha >='{$fechaHoy}'");
    //carga a la grilla si tine users inscriptos por el que inicio session en wordpress//
    $yaIsncriptos=DB::select("select * from vns_cursos_inscriptos as c join vns_periodos as p on c.idPeriodoF=p.idPeriodo join vns_cursos on vns_cursos.idCurso=p.idCursoF where c.idFacilitador='{$idLoginWp}' and c.periodoNombre='{$periodoNombre}'");
                   

     $roles=$this->siEsRol($categoArray);
    if($roles!=false){
    $roles=(implode(',',$roles));
    $puedeInscribir=DB::select("select puede_inscribir from vns_wp_pins where idCat in(".$roles.") and puede_inscribir=1");
    }else{$puedeInscribir='';}
    return view('Curso.inscripcion',compact("periodos",'periodoNombre','userLoginWp','yaIsncriptos','anio','puedeInscribir'));
  
   }else{ return view('Curso.inscripcion'); }//entra en else si la session no existe


  }//end inscripciones 



  public function almacena()
  {

   //agrega email permitido//
   $email=Request::get('email');

   $cursoPeriodoId=Request::get('curso');

   $fecha=Request::get('fecha');
   $fecha=trim($fecha);

   /*agrega a los cursos de tipo campus*/
   //if($fecha=="campus"){

    
    //dd("hola");
     //$this->almacenaCurso();
   

    //return 2;
   //}

   /*en agrega los cursos de tipo campus*/

  $EmailPermitido=Session::get('EmailPermitido');
  //varifica email duplicado //
 $EmailDuplicadoResultado=$this->EmailDuplicado($email,$cursoPeriodoId);
 //dd($EmailDuplicadoResultado);
if($EmailDuplicadoResultado !==false)
{
   return 'El Email Ingresado Ya Se Encuntra Inscripto En Este Curso';

}





 elseif(in_array($email, $EmailPermitido)){


          

         
         $idFacilitador=Session::get('idSession');

          $cursos=new CursosInscripto();
          //almacena el id periodo//
            $periodoNombre=Request::get('periodoNombre');
            $idPeriodo=Request::get('curso');
           
          //$idPeriodoF=DB::select("select idPeriodo from periodos where periodoNombre='{$periodoNombre}' and idCursoF='{$idCurso}'");
          //dd($idPeriodoF);
          $cursos->idperiodoF=$idPeriodo;
          $cursos->periodoNombre=$periodoNombre;
          $cursos->idFacilitador=$idFacilitador;//almacenar el id que viene desde wordpress y se recupera de la session//
          $nombreFacilitador=DB::connection('wordpress')->select("select  * from wp_pc_users where id='{$idFacilitador}'"); //obtiene  el nombre del facilitador
          $cursos->nombreFacilitador=$nombreFacilitador[0]->email;
         
       $idData=DB::connection('wordpress')->select("select * from wp_pc_users  where email='{$email}' and status=1 limit 1");
      $cursos->idUserInscripto=$idData[0]->id; // procesar  el email almacenar el id  que viene desde el worpres buscar el id en una consulta//

      //obtener todas las categorias que tienen un usuario//
                $categorias=$idData[0]->categories;
              
               $categorias=unserialize($categorias);

                          

                          foreach ($categorias as $value) {
                          
                            $result=DB::select("select grupo_id, pinName from vns_wp_pins where idCat='{$value}' ");

                            //dd($result);
                            //varifica que si el email que se queire ingresar no  almenos una catagoria validad por ejemplo rol pais ciudad//

                              if(empty($result)){
                             
                              return ' El Email INgresado NO tiene una Categoria Valida.'; 

                              }



                          

                                if($result[0]->grupo_id==1)
                                {//guardo el rol
                                       
                                 $cursos->rol=$result[0]->pinName;
                                }else if($result[0]->grupo_id==2){//guardo el pais
                                  
                                  $cursos->country=$result[0]->pinName;

                                }else if($result[0]->grupo_id==3){// guardo la ciudad o provincia


                                  $cursos->city=$result[0]->pinName;

                                }



                          }//end for


        
              










      //end obtener todas las categorias que tiene un usuario//
       //dd(date('d-n-Y'));
     
          $cursos->email=$email;
          $cursos->skype=Request::get('skype');

          $cursos->fechains=date('Y-m-d');
          $cursos->save();
         
          //return var_dump("hello")or die();

          return 2;
  

}else{ return 'No Tinen Permiso Para Agregar Este Email';}






  }//en function






public function EmailDuplicado($email,$cursoPeriodoId)
{



 $EmailCompare=$arrayName = array('0' =>$email.'-'.$cursoPeriodoId);
 $EmailDuplicado=DB::select("select * from vns_cursos_inscriptos as c where c.email='{$email}' and c.idPeriodoF='{$cursoPeriodoId}'");
 $resultado=count($EmailDuplicado);

 if($resultado==0){return false;}else{return true;}







}//end email duplicadio









public function UsuarioInscriptos()
{

$user=DB::select("select email, nombre, fecha from vns_cursos_inscriptos as c join vns_periodos as p on c.idPeriodoF=idPeriodo join vns_cursos on p.idCursoF=vns_cursos.idCurso");


return $user;

}





public function siesSoloJefe(){

  

$categoria=Session::get('categories');

//dd($categoria);

$categoria=implode(',',$categoria);



$rol=DB::select("select * from vns_wp_pins where idCat IN(".$categoria.")");

$cantRol=count($rol);

//dd($cantRol);


 if($cantRol==1)
 {

    if($rol[0]->pinName=="Jefe/Gerente")

    {
      return true; 
    }else{return false;}





 }




}















  public function loadGrilla()
  {
      $cursovalue=Request::get('cursoval');

       //dd($cursovalue);

       
       if(!is_numeric($cursovalue)){
    
       $data=Db::select("select *,idPeriodoF as nombre, 'ninguno' from vns_cursos_inscriptos order by idCursoInscripto desc limit 1");

        return $data;
       }



       $data=DB::select("select * from vns_cursos_inscriptos as c join vns_periodos as p on c.idPeriodoF=p.idPeriodo join vns_cursos on p.idCursoF=vns_cursos.idCurso order by idCursoInscripto desc limit 1");


    return $data;
  }














public function grillaDelete()
{
  
  $id=Request::get('id');

  //var_dump($datos) or die();

  DB::table('vns_cursos_inscriptos')->where('idCursoInscripto', '=', $id)->delete();

 return $id;

}


public function fechaCurso()
{
   $idPeriodo=Request::get('idPeriodo');
   $periodoNombre=Request::get('periodoNombre');
   $anio=Request::get('anio');

  
   //verifica si el id periodo es 0 el curso es de tipo  campus//

    if($idPeriodo==0){
  
     return "campus";

    }




   
    //$idPeriodo=DB::select("select idPeriodo from periodos where idCursoF='{$idCurso}' and periodoNombre='{$periodoNombre}' and fecha like '%{$anio}%' ");
    



    $idPeriodo=$idPeriodo;

  $response=DB::select("select fecha from vns_periodos where idPeriodo={$idPeriodo}");
  $fe=$response[0]->fecha;
  $fe=explode('-',$fe);
  $fecha=$fe[2]."/".$fe[1]."/".$fe[0];


  //var_dump($fecha) or die();
     return $fecha;

}








public function listUsersWp()
{

 //begin verifica si es solo jefe inscribe a todos//
  $esSoloJefe=$this->siesSoloJefe();
  if($esSoloJefe==true)
  {
    $result=DB::connection('wordpress')->select("select * from wp_pc_users where status='1' and categories is not null");

     foreach ($result as  $value) {
        $resultArray[]=$value->email;
     }

     Session::put('EmailPermitido',$resultArray);
     return $resultArray;

  }

//end si es solo jefe inscribe a todos//






  //Cargo las categorias desde la session para filtrar y saber a que usuarios puedo agregar//

  $categoriaLoginUser=Session::get('categories');
  $resultado=$this->siEsRol($categoriaLoginUser);
 
  //dd($inter);
  //dd($categoriaLoginUser);
    //dd($resultado);
   $resultado=implode(',', $resultado);
   $valorRemover=array_keys($categoriaLoginUser,$resultado);
   //dd($valorRemover);
   foreach ($valorRemover as $llave => $valor){
     unset($categoriaLoginUser[$valor]);
   }

   //dd($categoriaLoginUser);

  //array_shift($categoriaLoginUser);

  //$cantCataLoginUser=count($categoriaLoginUser);

    //$categoriaLoginUser=implode(',',$categoriaLoginUser);
  //dd($categoriaLoginUser)or die();

 






   /*obtengo la letra para buscar el  email */
  $emailSearch=Request::get('valor');
   




//se obtiene todos los usuarios y se realiza una interseccion entre las categorias con el usuario   logeado//

  $result=DB::connection('wordpress')->select("select * from wp_pc_users where status='1' and categories is not null"); 
    
  

  //var_dump($result) or die();

      
       foreach($result as $r){
               
            
            //obtengo la categoria de un usuario unserializado y lo guardo en un array//
          
        

                $idUser=$r->id;
                $email=$r->email;
                $cat=unserialize($r->categories);

                

                $array1[]=array('id'=>$idUser,'email'=>$email,'categoria'=>$cat);
             
              

            }
                
                //dd($array1);
               
        foreach ($array1 as $key => $value) {
                    
                                                 
                    $p=array_intersect($value['categoria'], $categoriaLoginUser);
                    if(count($categoriaLoginUser)==1 && count($p)==1){
                        $resultArray[]=$value['email'];
                    
                    }else if(count($categoriaLoginUser)==2 && count($p)==2){ 
                             $resultArray[]=$value['email'];
                             
                            }

        }

                        


            


Session::put('EmailPermitido',$resultArray);


return $resultArray;
}




//seleciona todos los periodos disponibles //

public function ajaxAnioPeriodoInscripcion()

{

  $anio=Request::get('anio');
  $fechaHoy=date('Y-m-d');



  $periodos=DB::select("Select distinct(p.periodoNombre) from vns_periodos as p   where EXTRACT(YEAR FROM fecha)='{$anio}' and p.fecha >='{$fechaHoy}'  order by fecha asc");


return $periodos;

}




//carga todos los cursos disponible para un periodo que tiene la fecha superior o igual a a la de hoy//
public function ajaxLoadCursoInscripcion()
{
  $periodoNombre=Request::get('periodoNombre');

  $anio=Request::get('anio');

  $fechaHoy=date('Y-m-d');

 $curso=DB::select("select * from vns_periodos join vns_cursos on vns_periodos.idCursoF=vns_cursos.idCurso where   fecha >='{$fechaHoy}' and periodoNombre='{$periodoNombre}' and fecha like '%{$anio}%'");


return $curso;

}



public function ajaxYainscripto()
{

$anio=Request::get('anio');
$periodoNombre=Request::get('periodoNombre');

/*obtniene el email del usuario logeado*/
 $idLoginWp=Session::get('idSession');

 $resultado=DB::select("select email from wp_pc_users where id={$idLoginWp}");
 $email=$resultado[0]->email;

/*end obtieuario logeado*/


$inscriptos=DB::select("select   * from vns_cursos_inscriptos as c_i left join vns_periodos  as p on c_i.idPeriodoF=p.idPeriodo left join vns_cursos on p.idCursoF=vns_cursos.idCurso where c_i.nombreFacilitador='{$email}' and c_i.periodoNombre='{$periodoNombre}' and c_i.created_at like '%{$anio}%'");

//dd($inscriptos);


return $inscriptos;
}





public function ajaxloadcursocampus()
{
   

   $cursos=DB::select("select * from vns_cursos where tipo ='campus'");

   //dd($cursos);

   return $cursos;

}



public function almacenaCurso(){

 $cursos=new CursosInscripto();

 $cursos->email=Request::get('email');
$cursos->skype=Request::get('skype');
 $cursos->save();



}




public function rolUserLogin()
{

 $idRol=Session::get('categories');
 
//dd($idRol);

 $idRol=implode(',',$idRol);
 $resultados=DB::connection('wordpress')->select("select name from wp_terms where term_id in ({$idRol})");
  echo "el usuario tiene las siguentes categorias<br></br>";

 foreach ($resultados as  $categorias) {
   
         echo $categorias->name."<br>";


 }




}



public function siEsRol($p){
$dato=[];
$categorias=implode(',',$p);
$resultado=DB::connection('wordpress')->select("select idCat from vns_wp_pins   where  idCat in(select idCat from vns_wp_pins where grupo_id='1' and idCat in(".$categorias."))
 
  ");
 if(!empty($resultado)){
   foreach ($resultado as $key => $value) {

      $dato[]=$value->idCat;
   }
}

if(count($dato)>=1){
 
 return $dato;

}else{ return false;}


}









}//end class








