<?php
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporteContactosAgenda.xls");
header("Pragma: no-cache");
header("Expires: 0");
set_time_limit(0); 

include("Clases/MySQL.php");

$MySQL = MySQL::getInstance();
$sql = 'SELECT idContacto, nombre, apellido FROM `a_contacto` WHERE idContacto NOT IN (SELECT DISTINCT(idContacto) FROM a_filtroaplicado_c)';
$MySQL->setQuery($sql);
$contactos = $MySQL->loadObjectList();

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">idContacto</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Nombre</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Apellido</font></font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Agenda</font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Agendas</font></strong></div></td>
  </tr>
  <?php 
  foreach($contactos as $contacto){ 
		$sql = 'SELECT a.descripcion FROM `a_contacto_agenda` ca INNER JOIN agendas a USING (idAgenda) WHERE idContacto = '.$contacto->idContacto;
		$MySQL->setQuery($sql);
		$agendas = $MySQL->loadObjectList();
		$arrAg = array();
		foreach($agendas as $agenda){
			$arrAg[] = $agenda->descripcion;
		}
  ?>
  <tr>
    <td><?php echo $contacto->idContacto;?></td>
    <td><?php echo $contacto->nombre;?></td>
    <td><?php echo $contacto->apellido;?></td>
    <td><?php echo $arrAg[0]; ?></td>
    <td><?php echo implode(', ',$arrAg); ?></td>
  <tr>
  <?php } ?>
</table>