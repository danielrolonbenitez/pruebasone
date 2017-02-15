<?php namespace App\Http\Controllers;
use DB;
use Request;
use Redirect;
use Hash;
use App\User;
use Input;
use Validator;
class UserController extends Controller {

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
		 $users=User::paginate('10');
		 $users->setPath('Usuario');

    return view('User.indexUser',compact('users'));
	}




public  function store(){
  
 $rules = array(
        'nombre'=>'required',
        'email'=>'required|unique:users',
        'pass'=>'required',
        
    );


	  $messsages = array(
       'nombre.required'=>'Debe Ingresar El nombre de un usuario',
       'email.required'=>'Debe Ingresar Un Email',
       'email.unique'=>' El Email ya Esta En Uso',
       'pass.required'=>'Debe Ingresar Un Password', 

       
    );

 $validator = Validator::make(Input::all(),$rules,$messsages);


if ($validator->fails()) {
            return Redirect::to('/AltaUsuario')->withErrors($validator);


}
      
      $user=new User();
      $user->nombre=Request::get('nombre');
      $user->email=Request::get('email');
      $user->password=hash::make(Request::get('pass'));
      $user->rol=2;

      $user->save();
 	 return Redirect::route('indexUser')->withFlashMessage('El Usuario Se Creo Correctamente.');
    


	
}


public  function UserEdit($id){


$datos =DB::select("select * from users where id={$id}");


return view('User.editUser')->with('datos',$datos);
	
}

public  function UserEditStore(){

	try{
			$idUser=Request::get('id');
			$nombre=Request::get('nombre');
			$email=Request::get('email');
             
             if(Request::get('pass')){
				$pass=hash::make(Request::get('pass'));
				DB::table('users')
			            ->where('id', $idUser)
			            ->update(array('nombre' => $nombre ,'email'=>$email,'password'=>$pass));	
				
				}else{
							DB::table('users')
			            		->where('id', $idUser)
			           			 ->update(array('nombre' => $nombre ,'email'=>$email));

			         }

			return Redirect::route('indexUser');
		}catch(Exception $e){

			return Redirect::route('UserEdit',$idUser)->withFlashMessage('El Email De  Usuario  Ya Existe !!Ingrese Otro Nombre!!');
		}


	
}








public  function deleteUser($id){

DB::table('users')->where('id', '=', $id)->delete();

return Redirect::route('indexUser')->withFlashMessage('El Usuario Se a Eliminado.');
}





}//end class