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
use Image;


class ResizeImagenController extends Controller {

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


 	$directory="img/negocio";
   	$dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false)
    {


    	  if (!is_dir($archivo)){
         			
         		

         			$url=$directory.'/'.$archivo;
         			$url=utf8_decode($url);

         			echo $url;

                     $imgUrlnew=$url;
     		
         			 $img = Image::make($imgUrlnew,100);
      				 $img->resize(354,200);
					 $img->save($imgUrlnew);




     		}



    }
   	 $dirint->close();

	return "las imagenes fueron resizeadas a 354 por 200";


}//end function//
}//end controller