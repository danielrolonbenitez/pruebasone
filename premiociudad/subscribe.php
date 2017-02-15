<?php
require_once('clases/mysql.php');

$query = "SELECT * FROM cf";
$MySQL = MySQL::getInstance();
$MySQL->setQuery($query);
$MySQL->execute();
$result = $MySQL->loadObjectList();

if($_GET['link'] == "PCJ2016"){
				
			
				

//se despliega el resultado  
echo "<table style='width: 100%;  font-family: 'trebuchet MS' , 'Lucida sans' , Arial;  font-size: 14px;  color: #444;  border: solid #ccc 1px; border-collapse: separate;  border-spacing: 0;-moz-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px;'><thead><tr>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>id</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>nombre</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>email</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>video</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>dni</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>telefono</th>";
echo "<th style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;background-color: #dce9f9;'>edad</th></tr></thead>";  

	foreach ($result as $k => $row){   
	    echo "<tr>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->id</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->nombre</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->email</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->video</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->dni</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->telefono</td>";  
	    echo "<td style='border-left: 1px solid #ccc;border-top: 1px solid #ccc;padding: 10px;text-align: left;'>$row->edad</td>";  
	    echo "</tr>";  
	}  
echo "</table>"; 
}
	else
{
	echo "404 Not Found";
} 

?>  