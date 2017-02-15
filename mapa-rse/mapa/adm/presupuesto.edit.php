<? include("vuelta.php"); include("../db.php");

if($perm->presupuestos!=2) exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script src="js/jquery.js"></script>


</head>

<body>


<? 
/*
$fop=fopen("texto.html","w+");
foreach($_GET as $key=>$val)
$t.="$key -> $val<br>";*/


switch($_GET[tipo])
{
	
	case "d":
			
			$f=fecha_a_mysql($_POST[fecha]);
				$sql="update  presupuesto set recaudacion='$_POST[recaudacion]',presupuesto='$_POST[presupuesto]', fecha_aprovacion='$f', consumido='$_POST[consumido]',saldo='$_POST[saldo]',pagos_extraordinarios='$_POST[pagos]' where id_presupuesto='$_POST[id]'";
				$query=mysql_query($sql); 
				
			
		break; 
		
			case "f":
			
			$f=fecha_a_mysql($_POST[fecha]);
				$sql="update  presupuesto set recaudacion='$_POST[recaudacion]',presupuesto='$_POST[presupuesto]', fecha_aprovacion='$f', consumido='$_POST[consumido]',saldo='$_POST[saldo]',pagos_extraordinarios='$_POST[pagos]' where id_presupuesto='$_POST[id]'";
				$query=mysql_query($sql); 
				
			
		break; 
			case "c":
			
			$f=fecha_a_mysql($_POST[fecha]);
				$sql="update  presupuesto set recaudacion='$_POST[recaudacion]',presupuesto='$_POST[presupuesto]', fecha_aprovacion='$f', consumido='$_POST[consumido]',saldo='$_POST[saldo]',pagos_extraordinarios='$_POST[pagos]' where id_presupuesto='$_POST[id]'";
				$query=mysql_query($sql); 
				
			
		break; 
		
		
		}
		
		/*	
			fwrite($fop,$t);
			fclose($fop);*/
		
			?>
            
            
</body>
</html>
