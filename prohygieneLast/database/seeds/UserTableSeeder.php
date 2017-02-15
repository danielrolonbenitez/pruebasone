<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    public function run()
    {
   
    	  DB::table('vns_users')->insert([

    	 [
            'name' => 'admin',
            'email' =>'admin@admin.com',
            'password' =>hash::make('12345678'),
            'rol'=>'1',
        ],
      
        [
            'name' => 'admin',
            'email' =>'admin@vnstudios.com',
            'password' =>hash::make('vnstudios2015'),
            'rol'=>'1',
        ]




        ]);



    }

}