<?php namespace App\Http\Controllers;

use Hash;
use Auth;
use Request;
use App\User;
use App\Negocio;
use App\Fotos;
use App\NegocioRubro;
use Redirect;
use DB;
use Session;
use Validator;
use Input;
use Image;


class NegocioController extends Controller {

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

public function index(){

$negocios=Negocio::paginate('10');
$negocios->setPath('Negocio');

return view('Negocio.indexNegocio',compact('negocios'));

}













	public function viewStore()

	{     



	$provincias=DB::select('select * from provincias');

	$ciudades=DB::select('select * from ciudades where  idProvinciaF=1 '); 
  $rubros=DB::select('select * from rubros');
  $entidades=DB::select('select * from entidades');



		return view("Negocio.negocioViewStore",compact('provincias','ciudades','rubros','entidades'));
	}


	
   public function store()
   {



$rules = array(
        'razonSocial'=>'required',
        'direccion'=>'required',
        'latitud'=>'required',
        'fotos.0'=>'image|max:2048',
    );





$inputArray=Input::all();
$cant=count($inputArray['fotosSlider']);



 for($j=0; $j<$cant; $j++){
        $rules['fotosSlider.'.$j] ='image|max:2048';
        
    }



$messages = array(
       'razonSocial.required'=>'Debe Ingresar El nombre de un Negocio',
       'direccion.required'=>'Debe Ingresar Una dirreccion',
       'latitud.required'=>'Debe marcar su Ubicación En El Mapa',
       'fotos.0.image'=>'La Imagen Principal  solo puede ser jpg y png',
       'fotos.0.max'=>'La Imagen Principal solo puede ser de 2 MB'
       
    );

 


 for($j=0; $j<$cant; $j++){
        $messages['fotosSlider.'.$j.'.image'] ='La Imagen Slider solo puede ser jpg y png';
        $messages['fotosSlider.'.$j.'.max'] ='La Imagen Slider solo puede ser de 2MB'; 
    }



 $validator = Validator::make(Input::all(),$rules,$messages);


if ($validator->fails()) {
            return Redirect::to('Admin/AltaNegocio')->withErrors($validator);


}


















   	   $negocio=new Negocio();
       
   	   $negocio->razonSocial=Request::get('razonSocial');
   	   $negocio->direccion=Request::get('direccion');
   	   $negocio->idProvinciaF=Request::get('provincia');
   	   $negocio->idCiudadF=Request::get('ciudad');
   	   $negocio->sitioWeb=Request::get('sitioWeb');
   	   $negocio->telefono=Request::get('telefono');
   	   $negocio->idEntidadF=Request::get('entidad');
   	   $negocio->estado=Request::get('estado');
   	   $negocio->latitud=Request::get('latitud');
   	   $negocio->longitud=Request::get('longitud');
   	   $negocio->save();
        
        //obtener el id del negocio que fue insertado//

   
   	    $id=DB::table('negocios')->max('idNegocio');

         //dd($_FILES['fotos']['size']);



        //pregunto si existe la fotos para el slider//
      

         //dd($_FILES['fotosSlider']);

         //dd(count($sizeSlider));
        $name=($_FILES['fotosSlider']['name'])? $_FILES['fotosSlider']['name']:false;


        if($name[0]!="")
        {

          
          $tmp=$_FILES['fotosSlider']['tmp_name'];
          $type=$_FILES['fotosSlider']['type'];
          $sizeSlider=$_FILES['fotosSlider']['size'];
          
          $this->AgregaFotoSlider($id,$name,$tmp,$type,$sizeSlider);
        }







         $size=$_FILES['fotos']['size'];
   	     if( $size[0]> 0)
   	    {

                                         



                                       	   //carga las fotos en  un array y genera las url.

                                         						  foreach ( $_FILES['fotos']['name'] as $name)
                                    							{
                                    								 	$url[]='public/img/negocio/'.rand(1,5000).$name;
                                    							}



                                              			//carga la direccion temporal para luego mover las imagenes a la url public/img/negocio/		
                                                 
                                                 				 foreach ( $_FILES['fotos']['tmp_name'] as $tmp )
                                              				{
                                              					$temp[]=$tmp;
                                              				}

              
                
				                                                      $cant=count($url);//obtengo la cantidad de url que necesito//
				 

				              for($i=0;$i<$cant;$i++)
			                                       	{
                  			
                                            	move_uploaded_file($temp[$i],'.../../../'.$url[$i]);
                                            	$foto=new Fotos();
                                  						$foto->idNegocioF=$id;
                                              //antes de guadar la paso a tumbails//

                                              
                                              $imgUrl=explode('public/',$url[$i]);
                                              $imgUrlnew=$imgUrl[1];

                                              //dd($imgUrl);


                                              $img = Image::make($imgUrlnew,100);
      
                                              $img->resize(139,139);

                                              $img->save($imgUrlnew);



                                  						$foto->url=$url[$i];
                                              $foto->status='active';
                                  						$foto->save();
                                              
                                              }


            
         }else{   
                   $foto=new Fotos();
                   $foto->idNegocioF=$id;
                   $foto->url='public/img/negocio/default.jpg';
                   $foto->status='active';
                   $foto->save();
              }//end if //si no selecciona una foto carga por default una;


                      /*almacena rubros*/

                        $rubros=Request::get('rubro');

                        //var_dump($r)or die();

                        $cantRubros=count($rubros);

  						
  						for($i=0;$i<$cantRubros;$i++){
  							

  							$negocioRubro= new NegocioRubro();

  							$negocioRubro->idNegocioF=$id;
  							$negocioRubro->idRubroF=$rubros[$i];
  							$negocioRubro->save();



  						}
















   	   //var_dump($id)or die();

       return redirect::route('indexNegocio');



   }//end stored



public function AgregaFotoSlider($idNegocio,$names,$tmps,$type,$size)
{
    

if($names){

    //dd($names);



                                           //carga las fotos en  un array y genera las url.

                                                      foreach ( $names as $name)
                                                  {
                                                      $url[]='public/img/negocio/'.rand(1,5000).$name;
                                                  }



                                                    //carga la direccion temporal para luego mover las imagenes a la url public/img/negocio/    
                                                 
                                                         foreach ( $tmps as $tmp )
                                                      {
                                                        $temp[]=$tmp;
                                                      }

              
                
                                                              $cant=count($url);//obtengo la cantidad de url que necesito//
         

                      for($i=0;$i<$cant;$i++)
                                              {
                        
                                              move_uploaded_file($temp[$i],'.../../../'.$url[$i]);
                                              $foto=new Fotos();
                                              $foto->idNegocioF=$idNegocio;


                                              //antes de guadar la paso a tumbails//

                                              
                                              $imgUrl=explode('public/',$url[$i]);
                                              $imgUrlnew=$imgUrl[1];

                                              //dd($names);

                                            if(!empty($names[0])){

                                              $img = Image::make($imgUrlnew,100);
      
                                              $img->resize(354,200);

                                              $img->save($imgUrlnew);
                                            }








                                            
                                              $foto->url=$url[$i];
                                            
                                              $foto->save();
                                              
                                              }


 
}//end if




}//end function

























public function negocioEdit($id)

{

  $negocios=DB::select("select * from negocios where idNegocio='{$id}'");
  $provincias=DB::select("select * from provincias");
  //var_dump($provincias)or die();
  $ciudades=DB::select("select * from ciudades");
  $enti=DB::select("select * from entidades");
  //dd($negocios);
  $rubros=DB::select("select * from rubros where idRubro  not in (SELECT idRubroF FROM `negocios_rubros` WHERE idNegocioF={$id})");
  $rubrosLoad=DB::select("select * from negocios_rubros as n join  rubros as r on n.idRubroF=r.idRubro  where idNegocioF='{$id}'");
  $fotos=DB::select("select * from fotos where idNegocioF={$id} and status<>'active'");
  $fotoPrincipal=DB::select("select * from fotos where idNegocioF={$id} and status='active'");

  //var_dump($myLatLng)or die();

  return view('Negocio.editNegocio',compact('negocios','provincias','enti','rubrosLoad','rubros','ciudades','fotos','fotoPrincipal'));
                                    

}




public  function negocioEditStore(){
try{
  $idNegocio=Request::get('idNegocio');
  $latitud=Request::get('latitud');
  $longitud=Request::get('longitud');
  $razonSocial=Request::get('razonSocial');
  $direccion=Request::get('direccion');
  $provincia=Request::get('provincia');
  $ciudad=Request::get('ciudad');
  $sitioWeb=Request::get('sitioWeb');
  $telefono=Request::get('telefono');
  $identidad=Request::get('entidad');
  $estado=Request::get('estado');



  DB::table('negocios')
              ->where('idNegocio', $idNegocio)
              ->update(array('razonSocial' => $razonSocial , 'latitud'=>$latitud,'longitud'=>$longitud ,'direccion'=>$direccion,'idProvinciaF'=>$provincia,'idCiudadF'=>$ciudad,'sitioWeb'=>$sitioWeb,'telefono'=>$telefono,'idEntidadF'=>$identidad,'estado'=>$estado));

   
   //actualiza rubros//

      $rubro=Request::get('rubro');
  //dd($rubro);
  
         if(isset($rubro)){  
                
                            
                                 DB::table('negocios_rubros')->where('idNegocioF', $idNegocio)->delete();


                               foreach ($rubro as $value) {



                                                    

                                                          DB::insert('insert into negocios_rubros (idNegocioF, idRubroF) values (?, ?)', array($idNegocio,$value));





                                                           }

                                }







  //end actualiza rubros//


  return Redirect::route('indexNegocio')->withFlashMessage('El Negocio Se a Editado Correctamente');


  }catch(Exception $e){

    return Redirect::route('negocioEdit',$idNegocio)->withFlashMessage('El Negocio Ya Existe !!Ingrese Otro Nombre!!');
  }
  


}
















public  function deleteNegocio($id){

DB::table('negocios')->where('idNegocio', '=', $id)->delete();
DB::table('negocios_rubros')->where('idNegocioF', '=', $id)->delete();
DB::table('fotos')->where('idNegocioF', '=', $id)->delete();

return Redirect::route('indexNegocio')->withFlashMessage('Negocio Se a Eliminado.');
}





public function editarFotos($id,$negocio)
{
  //dd($negocio);
  
//Session::put('id',$id);

   
$url=DB::select("select url from fotos where idFoto={$id}");


 


  return view('Negocio.editFoto')->with('url',$url)->with("idFoto",$id)->with('idNegocio',$negocio);
}


public function editarFotoStore(){


     $id=Request::get('idNegocio');
     $nombre=$_FILES['fotos']['name'];
     $idFoto=Request::get('idFoto');

 
                                          
     
$url='public/img/negocio/'.rand(1,5000).$nombre;



                                              move_uploaded_file($_FILES['fotos']['tmp_name'],'.../../../'.$url);
    $imgUrl=explode('public/',$url);
     $imgUrlnew=$imgUrl[1];
                                              

     $img = Image::make($imgUrlnew,100);
     $img->resize(139,139);
     $img->save($imgUrlnew);


                                             
  DB::table('fotos')
              ->where('idFoto', $idFoto)
              ->update(array('url' => $url));




return Redirect::route('negocioEdit',$id);
}







public function addMorePic($id)
{
   //dd($id);
  return view('Negocio.agregaFoto')->with('idNegocio',$id);
}


public function addMorePicStore()
{
    $id=Request::get('idNegocio');

 //carga las fotos en  un array y genera las url.

                                                      foreach ( $_FILES['fotos']['name'] as $name)
                                                  {
                                                      $url[]='public/img/negocio/'.rand(1,5000).$name;
                                                  }



                                                    //carga la direccion temporal para luego mover las imagenes a la url public/img/negocio/    
                                                 
                                                         foreach ( $_FILES['fotos']['tmp_name'] as $tmp )
                                                      {
                                                        $temp[]=$tmp;
                                                      }

              
                
                                                              $cant=count($url);//obtengo la cantidad de url que necesito//
         

                      for($i=0;$i<$cant;$i++)
                                              {
                        
                                              move_uploaded_file($temp[$i],'.../../../'.$url[$i]);
                                              $foto=new Fotos();

                                             
                                              $imgUrl=explode('public/',$url[$i]);
                                              $imgUrlnew=$imgUrl[1];


                                              $img = Image::make($imgUrlnew,100);
      
                                              $img->resize(354,200);

                                              $img->save($imgUrlnew);
                                          





                                              $foto->idNegocioF=$id;
                                              $foto->url=$url[$i];
                                              $foto->save();
                                              
                                              }




return Redirect::route('negocioEdit',$id);
}



public  function eliminarFotoNegocio($idFoto ,$idNegocio){


 ///obtengo la cantidad de fotos que tiene cada negocio si solo tiene una no se puede eliminar//

  $status=DB::select("select * from fotos where idFoto='{$idFoto}'");



 if($status[0]->status==""){

 DB::table('fotos')->where('idFoto', '=', $idFoto)->delete();

return Redirect::route('negocioEdit',$idNegocio)->withFlashMessage('La Foto Se a Eliminado.');

}else{

  return Redirect::route('negocioEdit',$idNegocio)->withFlashMessage('Nose Peude Eliminar la Foto Principal Debe tener al Menos Una.');
}









}//end function




/*begin edit fotos to slider*/

public function editarFotoSlider($id,$negocio)
{
  //dd($negocio);
  
//Session::put('id',$id);

   
$url=DB::select("select url from fotos where idFoto={$id}");


 


  return view('Negocio.editFotoSlider')->with('url',$url)->with("idFoto",$id)->with('idNegocio',$negocio);
}


public function editarFotoStoreSlider(){


     $id=Request::get('idNegocio');
     $nombre=$_FILES['fotos']['name'];
     $idFoto=Request::get('idFoto');

 
                                          
     
$url='public/img/negocio/'.rand(1,5000).$nombre;



                                              move_uploaded_file($_FILES['fotos']['tmp_name'],'.../../../'.$url);
    $imgUrl=explode('public/',$url);
     $imgUrlnew=$imgUrl[1];
                                              

     $img = Image::make($imgUrlnew,100);
     $img->resize(354,200);
     $img->save($imgUrlnew);


                                             
  DB::table('fotos')
              ->where('idFoto', $idFoto)
              ->update(array('url' => $url));




return Redirect::route('negocioEdit',$id);
}


















/*end foto slider*/







}//end controller