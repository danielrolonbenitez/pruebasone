<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class PeriodoTableSeeder extends Seeder {

    public function run()
    {
   
DB::table('periodos')->insert([
                   
['periodoNombre'=>'Periodo 7','destinado'=>'General','idCursoF'=>'3','capacitador'=>'Marcos','fecha'=>'2016-05-24'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos','idCursoF'=>'1','capacitador'=>'Marcos','fecha'=>'2016-05-26'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos', 'idCursoF'=>'2','capacitador'=>'Marcos','fecha'=>'2016-05-26'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos','idCursoF'=> '7','capacitador'=>'Claudio','fecha'=>'2016-06-01'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Ténicos y Bodegueros','idCursoF'=> '5','capacitador'=>'Marcos','fecha'=>'2016-06-02'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'General', 'idCursoF'=>'3','capacitador'=>'Marcos','fecha'=>'2016-06-07'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos', 'idCursoF'=>'1','capacitador'=>'Marcos','fecha'=>'2016-06-08'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos', 'idCursoF'=>'2','capacitador'=>'Marcos','fecha'=>'2016-06-08'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Retencion y Fidelizacion','idCursoF'=> '8','capacitador'=>'Claudio','fecha'=>'2016-06-13'],
['periodoNombre'=>'Periodo 7','destinado'=> 'Jefes y Gerentes', 'idCursoF'=>'4','capacitador'=>'Pablo/Flor','fecha'=>'2016-06-14'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Ejecutivos de Cuenta', 'idCursoF'=>'10','capacitador'=>'Claudio','fecha'=>'2016-06-15'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Retencion y Fidelizacion', 'idCursoF'=>'11','capacitador'=>'Claudio','fecha'=>'2016-06-16'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos', 'idCursoF'=>'4','capacitador'=>'Marcos','fecha'=>'2016-06-09'],
['periodoNombre'=>'Periodo 8', 'destinado'=>'vendedores y ejecutivos', 'idCursoF'=>'4','capacitador'=>'Claudio','fecha'=>'2016-07-12'],
['periodoNombre'=>'Periodo 8', 'destinado'=>'Ejecutivos de Cuentas', 'idCursoF'=>'4','capacitador'=>'Claudio','fecha'=>'2016-07-04'],
['periodoNombre'=>'Periodo 8', 'destinado'=>'General','idCursoF'=>'4','capacitador'=>'Marcos','fecha'=>'2016-07-05'],
['periodoNombre'=>'Periodo 7', 'destinado'=>'Vendedores y Ejecutivos','idCursoF'=>'4','capacitador'=>'Marcos','fecha'=>'2016-05-31']



                    ]);



    }

}