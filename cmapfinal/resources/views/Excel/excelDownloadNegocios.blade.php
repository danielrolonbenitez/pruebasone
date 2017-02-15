<?php

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=ReporteListadosNegocios.xls");
header("Pragma: no-cache");
header("Expires: 0");


?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
       <td align='center' colspan="8" style="background-color:#286BCC;color:white;height:50px"><div style="padding-bottom:100px;"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="4">CAME|Mapa Argentina Negocios Asociados</font></font></strong></div></td>

  </tr>


  <tr>
    
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Razon Social</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Dirección</font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Localidad</font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Provincia</font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Sitio Web</font></strong></div></td> 
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Telefono</font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Rubros</font></strong></div></td> 
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"></font>Camara</font></strong></div></td>    
  </tr>
  <?php foreach ($data as $negocio){
    
  echo"<tr>";
            echo"<td align='center'>".$negocio->razonSocial."</td>";
            echo "<td align='center'>".$negocio->direccion."</td>";
            echo "<td align='center'>".$negocio->ciudadNombre."</td>";
            echo "<td align='center'>".$negocio->provinciaNombre."</td>";
            echo "<td align='center'>".$negocio->sitioWeb."</td>";
            echo "<td align='center'>".$negocio->telefono."</td>";
            echo "<td align='center'>".$negocio->rubro_nombre."</td>";
            echo "<td align='center'>".$negocio->entidadNombre."</td>";

  echo"</tr>";

}?>



</table>