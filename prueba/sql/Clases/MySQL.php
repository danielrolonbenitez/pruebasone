<?php
error_reporting(0);
class MySQL {

    private $conexion;
    private $resource;
    private $sql;
    public static $queries;
    private static $_singleton;

    public static function getInstance(){
        if (is_null (self::$_singleton)) {
            self::$_singleton = new MySQL();
        }
        return self::$_singleton;
    }

    private function __construct(){

        if($_SESSION['registrado']['idUsuario']==49){
           // include_once("/Applications/XAMPP/xamppfiles/htdocs/fenix/Controladores/ControladorUsuarios.php");
            $controladorUsuarios = new ControladorUsuarios();
            $controladorUsuarios->guardarLog($_POST,$_GET);
        }

        $this->conexion = @mysql_connect('localhost','root','');
        mysql_select_db('fenix', $this->conexion);
        mysql_set_charset('utf8',$this->conexion);
        self::$queries = 0;
        $this->resource = null;
    }

    public function execute(){
        if(!($this->resource = mysql_query($this->sql, $this->conexion))){
            return null;
        }
        self::$queries++;
        return $this->resource;
    }

    public function alter(){
        if(!($this->resource = mysql_query($this->sql, $this->conexion))){
            return false;
        }
        return true;
    }

    public function getNumRows(){
        if (!($cur = $this->execute())){
            return null;
        }
        $cantidad = mysql_num_rows($cur);
        return $cantidad;
    }

    public function loadObjectList(){
        if (!($cur = $this->execute())){
            return null;
        }
        $array = array();

        while ($row = @mysql_fetch_object($cur)){
            $array[] = $row;


        }

        return $array;
    }



    public function setQuery($sql){
        if(empty($sql)){
            return false;
        }
        $this->sql = $sql;
        return true;
    }

    public function getId(){
        $id = $this->resource = mysql_insert_id();
        return $id;
    }

    public function freeResults(){
        @mysql_free_result($this->resource);
        return true;
    }

    public function loadObject(){
        if ($cur = $this->execute()){
            if ($object = mysql_fetch_object($cur)){
                @mysql_free_result($cur);
                return $object;
            }
            else {
                return null;
            }
        }
        else {
            return false;
        }
    }

    function __destruct(){
        @mysql_free_result($this->resource);
        @mysql_close($this->conexion);
    }
}
?>