<?Php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CursoTableSeeder extends Seeder {

    public function run()
    {
   
 DB::table('cursos')->insert([
['nombre'=>'Comercialización |','desCorto'=>'Prospeccion y Concertacion De Demos','descripcion'=>'<strong>IMPORTANTE:</strong> la charla está dirigida para <strong>NUEVOS ingresantes</strong> o con poco tiempo en la empresa.<bt>\n\n¿Qué aspectos debemos tener en cuenta antes y durante la concertación de una demo? Tenerlos presentes definirán luego el éxito en su colocación.<br>\n\nLa etapa de Seguimiento nos permitirá verificar el cambio producido en términos de higiene una vez instalados nuestros'],
['nombre'=>'Comercialización ||','desCorto'=>'Seguimiento Y cierre','descripcion'=>'La etapa de seguimiento nos permitira verificar el cambio producido en terminos de higiene una Vez instalado nuestro sistema,es necesario entonces durante  esta etapa, trabajar sobrela percepcion que tiene nuestro potencial cliente en relacion a los beneficios de los mismos'],
['nombre'=>'Inducción','desCorto'=>'Definición del Negocio. Cultura e Identidad ','descripcion'=>'Capacitación dirigida a los NUEVOS ingresantes de todas las operaciones.'],
['nombre'=>'Comercialización III','desCorto'=>'Manejo de Objeciones','descripcion'=>'<strong>IMPORTANTE:</strong> la charla está dirigida para <strong>NUEVOS ingresantes</strong> o con poco tiempo en la empresa.<br>\n\nDado que las objeciones son parte natural del proceso de venta: ¿Qué métodos debemos tener en cuenta para poder resolver las barreras que interpone el cliente, con el objeto de realizar una propuesta de alto valor?'],
['nombre'=>'Nuestros Sistemas:','desCorto'=>'Aromatizacion','descripcion'=>'Nuestras mopas y alfombras son las que constituyen al  sistema de Control de Polvo. Ambas colaboran positivamente con la imagen del negocio de nuestro cliente. \r\nEs por ello que, es necesario profundizar nuestro conocimiento de dichos productos, de manera de hacer nuestra gestión más profesional y efectiva.'],
['nombre'=>'Misión tareas y agenda del Ejecutivo','desCorto'=>'','descripcion'=>'Para poder concretar de manera eficiente las diferentes tareas que incluye el rol de Ejecutivo de Cuentas es de suma  importancia  tener en claro la mision delppuesto y gestionar la agenda diaria y sus tiempos. Compartiremos las mejores prácticas que permiten resultados mas eficientes en la concreción de estas tareas.'],
['nombre'=>'clientes matrices','desCorto'=>'clientes matrices','descripcion'=>'La charla tiene como objetivo explicar la importancia de cada uno de los elementos que debemos tener en cuenta a la hora de negociar con Clientes Matrices.'],
['nombre'=>'Retención y Fidelización:','desCorto'=>'Motivos reales y posibles soluciones','descripcion'=>'<strong>IMPORTANTE:</strong> la charla está destinada para el rol de <strong>RETENCIÓN Y FIDELIZACIÓN.</strong><br>\n\nEl proceso de bajas debería ser tomado como una oportunidad de negocio. Su correcta gestión nos permite proyectar confianza y la imagen de una organización seria: ¿Qué procedimientos y acciones necesitamos tener en cuenta para ello?<br>\nDesarrollaremos una serie de lineamientos que '],
['nombre'=>'Análisis del Tablero de Cobranza','desCorto'=>'Análisis del Tablero de Cobranza','descripcion'=>'Un correcto y periódico análisis del Tablero de Cobranza ayuda al desarrollo del objetivo de recupero, es decir, ayuda al flujo de la caja.<br>\nTambién, contribuye a disminuir el índice de baja de Clientes, controlar objetivos, pendientes de cobro y seguimientos a partir de la generación de<strong>CRM.</strong><br>\nDesarrollaremos estos puntos con el fin de lograr un profundo análisis del Tablero '],
['nombre'=>'Gestión de Cobranza','desCorto'=>'Inicial','descripcion'=>'<strong>IMPORTANTE:</strong> la charla está destinada a los<strong> NUEVOS Ejecutivos de Cuenta</strong> que se incorporan a las operaciones con la finalidad de afianzar conceptos básicos de la cobranza y cómo llevarla a cabo.'],
['nombre'=>'Retención y Fidelización de Clientes:','desCorto'=>' Role Playing','descripcion'=>'<strong>IMPORTANTE:</strong> la charla está destinada para el rol de <strong>RETENCIÓN Y FIDELIZACIÓN.</strong><br>\n\nEl proceso de bajas debería ser tomado como una oportunidad de negocio. Su correcta gestión nos permite proyectar confianza y la imagen de una organización seria: ¿Qué procedimientos y acciones necesitamos tener en cuenta para ello?<br>\nEn este escuentro desarrollaremos, a través de']




           ]);



    }

}