<section id="terciarias">

      <?php 
	  	foreach($notas_terciarias as $terciaria){		
		$nota = $modeloFECOBA->buscarPorId($terciaria->id_noticia); 
		?>
	<article>
      <div class="info">
	  <?php if($nota->getIdSector() != 5){?>
      <h4><span><?php echo utf8_encode($nota->getSector()); ?></span></h4>
      <?php } ?>
        <?php if($nota->getImagenPrincipal() != ''){?>
          <figure><img src="<?php echo $this->basepath; ?>images/img/<?php echo $nota->getImagenPrincipal(); ?>" width="214" border="0" /></figure>
        <?php } ?>
        <h3><?php echo $nota->getTitulo(); ?></h3>
        
      <p><?php if($nota->getId() == "1081" || $nota->getId() == "1071"){echo utf8_encode($nota->getTextoCorto());} else {echo strip_tags(utf8_encode($nota->getTextoCorto()));} ?></p>
        <a href="?m=ver_tema&id=<?php echo $nota->getId(); ?>" class="leermas">LEER MAS</a>
        </div>
      <div class="clear"></div>
      </article>
      <?php } ?>
      <div class="clear"></div>
</section>