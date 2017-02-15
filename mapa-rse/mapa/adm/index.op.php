<? include_once("init.php");
if($_GET[oper]=="showeventos")
{
	$w.=($_GET[pasado]==1)? "":" and fecha>=now() ";
	$w.=($_GET[cat]) ? " and id_categoria='$_GET[cat]' ":"";
	
	if($_GET[txt]>'')
	{
		$t=trim($_GET[txt]);
		$w.="and (e.titulo like '%$t%' or e.lugar like '%$t%' or e.desc_larga like '%$t%') ";
	}
	if($cat>0 || $_GET[pasado]==1 || $_GET[txtevento]>'') $segun=" según su criterio de búsqueda";
	$where=" where e.id_evento>0 $w ";
	
	$sql=	"select * from eventos  e
			left join camaras c on c.id_camara=e.id_camara 
			left join federaciones f on f.id_federacion=e.id_federacion 
			$where  order by e.fecha desc  limit 100";
	
	$query=mysql_query($sql); echo mysql_error();
	$row=mysql_num_rows($query);
	
	if($row==0)
	{ echo "<div align='center'><div id='anuncio'>No hay eventos registrados"."$segun.</div></div>"; exit;}	
		
		while($dat=mysql_fetch_array($query))
		{
		
			$realizador=($dat[id_camara]>0) ? "<img src='../images/dots/mini_red-pushpin.png'>$dat[cam_nombre] ($dat[cam_abreviacion])" :  "<img src='../images/dots/mini_blue-pushpin.png'>$dat[fed_nombre] ($dat[fed_abreviacion])" ;
			
		$linkx=str_replace("http://","",$dat[8]); 
		if(trim($linkx)>'') $linkx="http://".$linkx;
		
		// lugar
		$f=explode("-",$dat[fecha]);
		$f=($dat[fecha]) ? "Fecha: ".$f[2]."/".$f[1]."/".$f[0] : " No definido";
		$h=($dat[hora]>"") ? ". Horario: $dat[hora]":" Consulte";
		$l=($dat[lugar]>"")? ". Lugar: $dat[lugar].":" Consulte.";
		$fechahoralugar=$f.$h.$l;	
		$idd++;
		
		switch ($dat[id_categoria])
		{
		case 1: $catstr="Sensibilización"; $cattitle='Actividades de Sensibilización dirigidas a mejorar la competitividad de las PYMES en ejes comerciales'; break;
		case 2: $catstr="Capacitación";$cattitle='Actividades de Capacitación para fortalecer la gestión de las PYMES comerciales y de servicios'; break;
		case 3: $catstr="Asistencia"; $cattitle='Actividades de Asistencia técnica dirigidas a incrementar la competitividad de las PYMES comerciales y de servicios'; break;
		
		}
		
		echo "<div id='eventocontent'>";
		echo "<div style='font-size:14px; color: #666; margin-bottom: 4px'>".utf8_decode($realizador)."</div>";
		echo "<div class='tituloevento'>$dat[titulo] <span class='categoriaevento' title='$cattitle'> [ $catstr ] </span></div>";
		echo "<div class='textocortoevento'>$dat[desc_corta]<span class='leer' onclick='$(this).parent().hide(); $(\"*[oculto=$idd]\").show();'>&nbsp[+] AMPLIAR.</span></div>";
		echo "<div class='textolargoevento' oculto='$idd'>".nl2br($dat[desc_larga])."<span class='leer' onclick='$(this).parent().prev().show(); $(this).parent().hide();'>&nbsp[-] REDUCIR.</span></div>";
			
			
			
			/*if(trim($dat[img])>"")
			 echo '<a href="'.$dat[img].'" rel="facebox"><img   style="margin: 5px 5px 5px 0; border:0"  src="'.$dat[img].'" class="img_th_evento" title="click para ampliar"></a>';*/
			  
				if(trim($dat[img])>"")
				echo "<input type='button' value='Ver Galería de Fotos' onclick='window.open(\"$dat[img]\")'>"  ;
			
			echo "<div class='fechahoralugar'>$fechahoralugar</div>";
			if($linkx>"") echo "<div class='linkevento'>Mas información: <a href='$linkx' target='_blank'>$linkx</a></div>";
			echo "</div>";
		}
		
}
if($_GET[oper]=="contadorPublico")
{
	$sql="delete from contexto where nombre='contadorpublico'";
	$query=mysql_query($sql);
	
	$sql="insert into contexto set nombre='contadorpublico', valor='$_GET[contador]'";
	$query=mysql_query($sql);
}

?>
