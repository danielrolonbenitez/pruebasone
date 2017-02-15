<?php

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=ReporteListadosRubros.xls");
header("Pragma: no-cache");
header("Expires: 0");


?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<table width="50%" border="1" cellspacing="0" cellpadding="0">
  <tr>
       <td align='center' colspan="2" style="background-color:#286BCC;color:white;height:50px"><div style="padding-bottom:100px;"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="4">CAME|Mapa Argentina Rubros Asociados</font></font></strong></div></td>

  </tr>


  <tr>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">ID</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">NOMBRE</font></font></strong></div></td>
    
  </tr>
  <?php foreach ($rubros as $rubro){
    
  echo"<tr>";
            echo"<td align='center'>".$rubro->idRubro."</td>";
            echo "<td align='center'>".$rubro->nombre."</td>";

  echo"</tr>";

}?>



</table>