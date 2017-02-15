<? session_start(); 
include_once("perm.inc");
if(!$_SESSION['adminCAME']) {header("location: login.php"); exit; }
else
{
 $perm=unserialize($_SESSION['adminCAME']); 
}
?>