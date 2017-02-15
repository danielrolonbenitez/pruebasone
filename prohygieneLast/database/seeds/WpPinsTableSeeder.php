<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class WpPinsTableSeeder extends Seeder {

    public function run()
    {
   
<<<<<<< HEAD
  $resultados=DB::connection('wordpress')->select("select * from wp_terms");

 foreach($resultados as $resultado){

            switch ($resultado->name) {
            	/*asigno los roles*/
            	case 'jefe/gerente':
            		$grupo_id=1;
            		break;
            	case 'Ejecutivo de Cuentas':
            		$grupo_id=1;
            		break;
            	case 'Capital Humano':
            		$grupo_id=1;
            		break;
            	case 'Asesor Comercial':
            		$grupo_id=1;
            		break;
            	case 'Bodega/Depósito':
            		$grupo_id=1;
            		break;
            	case 'Logística':
            		$grupo_id=1;
            		break;
            	case 'Resp. Calidad':
            		$grupo_id=1;
            		break;
            	case 'Retención y Fidelización':
            		$grupo_id=1;
            		break;
            	case 'Producción':
            		$grupo_id=1;
            		break;
            	case 'Soporte':
            		$grupo_id=1;
            		break;
            	case 'Argentina':
            		$grupo_id=2;
            		break;
            	case 'Bolivia':
            		$grupo_id=2;
            		break;
            	case 'Chile':
            		$grupo_id=2;
            		break;
            	case 'Colombia':
            		$grupo_id=2;
            		break;
            	case 'Costa Rica':
            		$grupo_id=2;
            		break;
            	case 'Ecuador':
            		$grupo_id=2;
            		break;
            	case 'EEUU':
            		$grupo_id=2;
            		break;
            	case 'El Salvador':
            		$grupo_id=2;
            		break;
            	case 'Guatemala':
            		$grupo_id=2;
            		break;
            	case 'Mexico':
            		$grupo_id=2;
            		break;
            	case 'Panamá':
            		$grupo_id=2;
            		break;
            	case 'Perú':
            		$grupo_id=2;
            		break;
            	case 'Paraguay':
            		$grupo_id=2;
            		break;
            	case 'Uruguay':
            		$grupo_id=2;
            		break;
            	case 'Mendoza':
            		$grupo_id=3;
            		break;
            	case 'Villa María':
            		$grupo_id=3;
            		break;
            	case 'Neuquen':
            		$grupo_id=3;
            		break;
            	case 'Rosario':
            		$grupo_id=3;
            		break;
            	case 'Salta':
            		$grupo_id=3;
            		break;
            	case 'AMBA':
            		$grupo_id=3;
            		break;
            	case 'Asunción':
            		$grupo_id=3;
            		break;
            	case 'Bahía Blanca':
            		$grupo_id=3;
            		break;
            	case 'Bariloche':
            		$grupo_id=3;
            		break;

            	case 'Barranquilla':
            		$grupo_id=3;
            		break;
            	case 'Bogotá':
            		$grupo_id=3;
            		break;
            	case 'Boyaca':
            		$grupo_id=3;
            		break;

            	case 'Bucaramanga':
            		$grupo_id=3;
            		break;
            	case 'Cali':
            		$grupo_id=3;
            		break;
            	case 'Comodoro Rivadavia':
            		$grupo_id=3;
            		break;
            	case 'Chaco':
            		$grupo_id=3;
            		break;
            	case 'Concepción':
            		$grupo_id=3;
            		break;
            	case 'Córdoba':
            		$grupo_id=3;
            		break;
            	case 'Cuenca':
            		$grupo_id=3;
            		break;
            	case 'Mexico DF':
            		$grupo_id=3;
            		break;
            	case 'Escobar':
            		$grupo_id=3;
            		break;
            	case 'Ezeiza':
            		$grupo_id=3;
            		break;
            	case 'Guayaquil':
            		$grupo_id=3;
            		break;
            	case 'Irapuato':
            		$grupo_id=3;
            		break;
            	case 'Ibagué':
            		$grupo_id=3;
            		break;
            	case 'Junín':
            		$grupo_id=3;
            		break;
            	case 'La Paz':
            		$grupo_id=3;
            		break;
            	case 'Libertad':
            		$grupo_id=3;
            		break;
            	case 'Lima':
            		$grupo_id=3;
            		break;
            	case 'Mar del Plata':
            		$grupo_id=3;
            		break;
            	case 'Manta':
            		$grupo_id=3;
            		break;
            	case 'Medellín':
            		$grupo_id=3;
            		break;
            	case 'Miami':
            		$grupo_id=3;
            		break;
            	case 'Montería':
            		$grupo_id=3;
            		break;
            	case 'Montevideo':
            		$grupo_id=3;
            		break;
            	case 'Neuquén':
            		$grupo_id=3;
            		break;
            	case 'Olavarría':
            		$grupo_id=3;
            		break;
            	case 'Pereira':
            		$grupo_id=3;
            		break;
            	case 'Querétaro':
            		$grupo_id=3;
            		break;
            	case 'Quito':
            		$grupo_id=3;
            		break;
            	case 'Rosario':
            		$grupo_id=3;
            		break;
            	case 'Salta':
            		$grupo_id=3;
            		break;
            	case 'Santa Fe':
            		$grupo_id=3;
            		break;
            	case 'San Luis':
            		$grupo_id=3;
            		break;
            	case 'Santiago':
            		$grupo_id=3;
            		break;
            	case 'Santa Cruz':
            		$grupo_id=3;
            		break;
            	case 'Tucumán':
            		$grupo_id=3;
            		break;
            	case 'Villavicencio':
            		$grupo_id=3;
            		break;
            	case 'Xela':
            		$grupo_id=3;
            		break;
            	case 'Zapaca':
            		$grupo_id=3;
            		break;
               case 'Sta Cruz de la Sierra':
                    $grupo_id=3;
            		break;
            	case 'Guanajuato':
                    $grupo_id=3;
            		break;
            	case 'Cdad. de Guatemala':
                    $grupo_id=3;
            		break;
            	case 'Santiago de Chile':
                    $grupo_id=3;
            		break;
            	


            	default:
            		$grupo_id="0";
            		break;
            }
    







  if($grupo_id!=="0"){//pregiunta si tiene asignado un grupo si no tine lo descarta para no insertat basura
    
    					 DB::table('wp_pins')->insert([

     					['idCat'=>$resultado->term_id,'pinName'=>$resultado->name,'grupo_id'=>$grupo_id],

     					]);
					 }
 
 }//end foreach



  /* DB::table('wp_pins')->insert([
=======
   DB::table('wp_pins')->insert([
>>>>>>> 2b37a039c2c3a7f6d1e4adcec772aeaaf4cc648e
           
['id'=>1,'idCat'=>1,'pinName'=>'Jefe/Gerente','grupo_id'=>1],
['id'=>2,'idCat'=>157,'pinName'=>'Argentina','grupo_id'=>2],
['id'=>3,'idCat'=> 158,'pinName'=>'Bolivia', 'grupo_id'=>2],
['id'=>4,'idCat'=> 159,'pinName'=>'Chile','grupo_id'=> 2],
['id'=>5,'idCat'=> 160, 'pinName'=>'Colombia', 'grupo_id'=>2],
['id'=>6, 'idCat'=>161, 'pinName'=>'Costa Rica', 'grupo_id'=>2],
['id'=>7, 'idCat'=>162, 'pinName'=>'Ecuador', 'grupo_id'=>2],
['id'=>8, 'idCat'=>163, 'pinName'=>'EEUU', 'grupo_id'=>2],
['id'=>9,'idCat'=> 164, 'pinName'=>'El Salvador', 'grupo_id'=>2],
['id'=>10, 'idCat'=>165, 'pinName'=>'Guatemala', 'grupo_id'=>2],
['id'=>11, 'idCat'=>166, 'pinName'=>'Mexico', 'grupo_id'=>2],
['id'=>12, 'idCat'=>167, 'pinName'=>'Panama', 'grupo_id'=>2],
['id'=>13, 'idCat'=>169, 'pinName'=>'Perú', 'grupo_id'=>2],
['id'=>14, 'idCat'=>168, 'pinName'=>'Paraguay', 'grupo_id'=>2],
['id'=>15, 'idCat'=>170, 'pinName'=>'Uruguay', 'grupo_id'=>2],
['id'=>16, 'idCat'=>181, 'pinName'=>'Mendoza', 'grupo_id'=>3],
['id'=>17, 'idCat'=>178, 'pinName'=>'Villa Maria', 'grupo_id'=>3],
['id'=>18, 'idCat'=>182, 'pinName'=>'Neuquen', 'grupo_id'=>3],
['id'=>19, 'idCat'=>184, 'pinName'=>'Rosario', 'grupo_id'=>3],
['id'=>20, 'idCat'=>185, 'pinName'=>'Salta', 'grupo_id'=>3],
['id'=>21, 'idCat'=>216, 'pinName'=>'AMBA', 'grupo_id'=>3],
['id'=>22, 'idCat'=>211, 'pinName'=>'Asunción', 'grupo_id'=>3],
['id'=>23, 'idCat'=>172, 'pinName'=>'Bahía Blanca', 'grupo_id'=>3],
['id'=>24, 'idCat'=>173, 'pinName'=>'Bariloche', 'grupo_id'=>3],
['id'=>25, 'idCat'=>192, 'pinName'=>'Barranquilla', 'grupo_id'=>3],
['id'=>26, 'idCat'=>193, 'pinName'=>'Bogotá', 'grupo_id'=>3],
['id'=>27, 'idCat'=>195, 'pinName'=>'Boyaca', 'grupo_id'=>3],
['id'=>28, 'idCat'=>194, 'pinName'=>'Bucaramanga', 'grupo_id'=>3],
['id'=>29, 'idCat'=>196, 'pinName'=>'Cali', 'grupo_id'=>3],
['id'=>30, 'idCat'=>226, 'pinName'=>'Comodoro Rivadavia', 'grupo_id'=>3],
['id'=>31, 'idCat'=>176, 'pinName'=>'Chaco', 'grupo_id'=>3],
['id'=>32, 'idCat'=>227, 'pinName'=>'Concepción', 'grupo_id'=>3],
['id'=>33, 'idCat'=>177, 'pinName'=>'Córdoba', 'grupo_id'=>3],
['id'=>34, 'idCat'=>171, 'pinName'=>'Corporativo', 'grupo_id'=>3],
['id'=>35, 'idCat'=>161, 'pinName'=>'Costa Rica', 'grupo_id'=>3],
['id'=>36, 'idCat'=>228, 'pinName'=>'Cuenca', 'grupo_id'=>3],
['id'=>37, 'idCat'=>229, 'pinName'=>'México DF', 'grupo_id'=>3],
['id'=>38, 'idCat'=>164, 'pinName'=>'El Salvador', 'grupo_id'=>3],
['id'=>39, 'idCat'=>230, 'pinName'=>'Escobar', 'grupo_id'=>3],
['id'=>40, 'idCat'=>231, 'pinName'=>'Ezeiza', 'grupo_id'=>3],
['id'=>41, 'idCat'=>165, 'pinName'=>'Guatemala', 'grupo_id'=>3],
['id'=>42, 'idCat'=>203, 'pinName'=>'Guayaquil', 'grupo_id'=>3],
['id'=>43, 'idCat'=>197, 'pinName'=>'Ibagué', 'grupo_id'=>3],
['id'=>44, 'idCat'=>232, 'pinName'=>'Irapuato', 'grupo_id'=>3],
['id'=>45, 'idCat'=>179, 'pinName'=>'Junín', 'grupo_id'=>3],
['id'=>46, 'idCat'=>189, 'pinName'=>'La Paz', 'grupo_id'=>3],
['id'=>47, 'idCat'=>233, 'pinName'=>'Libertad', 'grupo_id'=>3],
['id'=>48, 'idCat'=>212, 'pinName'=>'Lima', 'grupo_id'=>3],
['id'=>49, 'idCat'=>212, 'pinName'=>'Lima', 'grupo_id'=>3],
['id'=>50, 'idCat'=>180, 'pinName'=>'Mar del Plata', 'grupo_id'=>3],
['id'=>51, 'idCat'=>204, 'pinName'=>'Manta', 'grupo_id'=>3],
['id'=>52, 'idCat'=>198, 'pinName'=>'Medellín', 'grupo_id'=>3],
['id'=>53, 'idCat'=>206, 'pinName'=>'Miami', 'grupo_id'=>3],
['id'=>54, 'idCat'=>199, 'pinName'=>'Montería', 'grupo_id'=>3],
['id'=>55, 'idCat'=>213, 'pinName'=>'Montevideo', 'grupo_id'=>3],
['id'=>56, 'idCat'=>182, 'pinName'=>'Neuquén', 'grupo_id'=>3],
['id'=>57, 'idCat'=>183, 'pinName'=>'Olavarría', 'grupo_id'=>3],
['id'=>58, 'idCat'=>167, 'pinName'=>'Panamá', 'grupo_id'=>3],
['id'=>59, 'idCat'=>200, 'pinName'=>'Pereira', 'grupo_id'=>3],
['id'=>60, 'idCat'=>210, 'pinName'=>'Querétaro', 'grupo_id'=>3],
['id'=>61, 'idCat'=>205, 'pinName'=>'Quito', 'grupo_id'=>3],
['id'=>62, 'idCat'=>184, 'pinName'=>'Rosario', 'grupo_id'=>3],
['id'=>63, 'idCat'=>185, 'pinName'=>'Salta', 'grupo_id'=>3],
['id'=>64, 'idCat'=>186, 'pinName'=>'San Luis', 'grupo_id'=>3],
['id'=>65, 'idCat'=>234, 'pinName'=>'Santa Cruz', 'grupo_id'=>3],
['id'=>66, 'idCat'=>187, 'pinName'=>'Santa Fe', 'grupo_id'=>3],
['id'=>67, 'idCat'=>235, 'pinName'=>'Santiago', 'grupo_id'=>3],
['id'=>68, 'idCat'=>188, 'pinName'=>'Tucumán', 'grupo_id'=>3],
['id'=>69, 'idCat'=>178, 'pinName'=>'Villa María', 'grupo_id'=>3],
['id'=>70, 'idCat'=>202, 'pinName'=>'Villavicencio', 'grupo_id'=>3],
['id'=>71, 'idCat'=>94, 'pinName'=>'Ejecutivo de Cuentas', 'grupo_id'=>1],
['id'=>72, 'idCat'=>129, 'pinName'=>'Capital Humano', 'grupo_id'=>1],
['id'=>73, 'idCat'=>236, 'pinName'=>'Xela', 'grupo_id'=>3],
['id'=>74, 'idCat'=>237, 'pinName'=>'Zapaca', 'grupo_id'=>3],
['id'=>75, 'idCat'=>238, 'pinName'=>'Asesor Comercial', 'grupo_id'=>1],
['id'=>76, 'idCat'=>239, 'Bodega/Depósito','grupo_id'=> 1],
['id'=>77, 'idCat'=>240, 'pinName'=>'Logística', 'grupo_id'=>1],
['id'=>78, 'idCat'=>242, 'pinName'=>'Resp. Calidad', 'grupo_id'=>1],
['id'=>79, 'idCat'=>243, 'pinName'=>'Retención y Fidelización', 'grupo_id'=>1],
['id'=>80, 'idCat'=>244, 'pinName'=>'Soporte', 'grupo_id'=>1],
['id'=>81, 'idCat'=>241, 'pinName'=>'Producción', 'grupo_id'=>1]

<<<<<<< HEAD
        ]);*/
=======
        ]);
>>>>>>> 2b37a039c2c3a7f6d1e4adcec772aeaaf4cc648e



    }

}