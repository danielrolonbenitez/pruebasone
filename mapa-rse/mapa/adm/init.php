<? 
include_once("perm.inc");
include_once("vuelta.php");
include_once("../db.php");
include_once("funciones.php");
define(_titulopagina_,"CAME Map &reg; - AIBICON&reg;");
if($_SERVER['HTTP_HOST']=='itaksrv') $key="ABQIAAAABzwwj2BPcqEEtkBy_7rgqBQVdiCgNdIQysLeyjpNPfGWFogrIRRToWe3zX6FwGkxaZljc0mJX2P0Gw";
else $key="ABQIAAAABzwwj2BPcqEEtkBy_7rgqBTvy9_hysg2goQYp-spJcQPceQhIhQeyAWV9J4R6fVmpdKxCbkBYwKJ0w";
define(_key_,$key);

foreach($_GET as $k => $v) {
	//echo $k . ' = \'' . addslashes($v) . '\';' . "\n";
	eval('$' . $k . ' = \'' . addslashes($v) . '\';');
}
?>
