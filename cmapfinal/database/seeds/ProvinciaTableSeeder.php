<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ProvinciaTableSeeder extends Seeder {

    public function run()
    {
   
    	  DB::table('provincias')->insert([
                     ['nombre'=>'Buenos Aires'],
					 ['nombre'=>'Buenos Aires-GBA'],
					 ['nombre'=>'Capital Federal'],
					 ['nombre'=>'Catamarca'],
					 ['nombre'=>'Chaco'],
					 ['nombre'=>'Chubut'],
					 ['nombre'=>'Córdoba'],
					 ['nombre'=>'Corrientes'],
					 ['nombre'=>'Entre Ríos'],
					 ['nombre'=>'Formosa'],
					 ['nombre'=>'Jujuy'],
					 ['nombre'=>'La Pampa'],
					 ['nombre'=>'La Rioja'],
					 ['nombre'=>'Mendoza'],
					 ['nombre'=>'Misiones'],
					 ['nombre'=>'Neuquén'],
					 ['nombre'=>'Río Negro'],
					 ['nombre'=>'Salta'],
					 ['nombre'=>'San Juan'],
					 ['nombre'=>'San Luis'],
					 ['nombre'=>'Santa Cruz'],
					 ['nombre'=>'Santa Fe'],
					 ['nombre'=>'Santiago del Estero'],
					 ['nombre'=>'Tierra del Fuego'],
					 ['nombre'=>'Tucumán']
        ]);



    }

}