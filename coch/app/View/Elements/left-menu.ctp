<div class="left">
	<nav>
		<a class="" href="<?php echo Router::url('/adm/empresa'); ?>">Nuestra empresa</a>
		<ul class="catalog">
			<li>
				<a class="" href="">Catálogo online</a>
				<ul>
					<?php foreach($categories as $category) :?>
					<li>
						<a href="<?php 
						echo Router::url('/adm/productos/' . Inflector::slug($category['Category']['name']) . '-' . $category['Category']['id'] . '.html');
						?>"><?php echo h($category['Category']['name']); ?></a>
						<?php if(!empty($category['Category'][0])) : ?>
						<ul>
							<?php foreach($category['Category'] as $key_c1 => $child1) : 
								if(!is_numeric($key_c1)) continue;
								?>
								<li>
									<a href="<?php 
						echo Router::url('/adm/productos/' . Inflector::slug($category['Category']['name'] . ' ' . $child1['name']) . '-' . $child1['id'] . '.html');
						?>"><?php echo h($child1['name']); ?></a>
									<?php if(!empty($child1[0])) : ?>
									<ul>
										<?php foreach($child1 as $key_c2 => $child2) : 
											if(!is_numeric($key_c2)) continue;
										?>
										<li>
											<a href="<?php 
						echo Router::url('/adm/productos/' . Inflector::slug($category['Category']['name'] . ' ' . $child1['name'] . ' ' . $child2['name']) . '-' . $child2['id'] . '.html');
						?>"><?php echo h($child2['name']); ?></a>
										</li>
										<?php endforeach; ?>
									</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		<a class="" href="<?php echo Router::url('/novedades'); ?>">Novedades</a>
		<a class="" href="<?php echo Router::url('/adm/ofertas'); ?>">Ofertas</a>
		<a class="" href="<?php echo Router::url('/adm/contacto', true); ?>">Contacto</a>
	</nav>

	<form class="newsletter" method="post" action="<?php echo h(Router::url('/', true)); ?>adm/add_newsletter" id="newsletter-form">
		<div class="title">Suscríbase a nuestro newsletter</div>
		<div class="know">y conozca las últimas noticias del sector</div>
		<input type="email" name="email" placeholder="Ingrese su E-mail">
		<button type="submit">Enviar</button>
	</form>
<?php
/* IMPORTANTE: No dejar ni espacios ni nada debajo del </div> de abajo que se rompe el maquetado */
?>
</div>