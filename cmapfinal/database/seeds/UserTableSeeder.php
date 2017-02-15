<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    public function run()
    {
   
    	  DB::table('users')->insert([
            'nombre' => 'admin',
            'email' =>'admin@admin.com',
            'password' =>hash::make('12345678'),
            'rol'=>'1',
        ]);



    }

}