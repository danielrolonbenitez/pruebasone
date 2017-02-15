<header class="site-header">
        <div class="container">
                <hgroup>
                        <h3 class="left site-title"><a href="<?php echo Router::url('/', true); ?>">COCH</a></h3>
                        <h6 class="left site-description FjO">La mejor soluci&oacute;n para su marmoler&iacute;a.</h6>
                </hgroup>
                <nav id="site-navigation" class="left main-navigation" role="navigation">
                        <ul class="nav-menu">
                                <li class="menu-item menu-item1"><a href="<?php echo h(Router::url('/', true)); ?>" class="FjO">HOME<span class="linea"></span></a></li>
                                <li class="menu-item menu-item2">
					<a href="#" onclick="return false">EMPRESA<span class="linea"></span></a>
					<ul class="nav-menu-seccion">
						<li class="menu-item-sub menu-item-sub1"><a href="<?php echo h(Router::url('/coch/page/1')); ?>">&iquest;Por qu&eacute; Coch?</a></li>
						<li class="menu-item-sub menu-item-sub1"><a href="<?php echo h(Router::url('/coch/page/2')); ?>">Coch en el mundo</a></li>
						<li class="menu-item-sub menu-item-sub1"><a href="<?php echo h(Router::url('/coch/imagenes')); ?>">Fotos</a></li>
						<li class="menu-item-sub menu-item-sub1"><a href="<?php echo h(Router::url('/coch/videos')); ?>">Videos</a></li>
					</ul>
				</li>
                                <li class="menu-item menu-item3">
					<a href="#" onclick="return false">PRODUCTOS<span class="linea"></span></a>
					<ul class="nav-menu-sub nav-menu-subbox">
						<?php 
						foreach($header_products as $product) : ?>
						<li class="menu-item-sub menu-item-sub1">
							<a href="<?php echo h(Router::url('/', true)); ?>coch/presentacion/<?php printf('%d', $product['Product']['id']); ?>">
								<img width="229" src="<?php echo h(Router::url('/', true)); ?>files/<?php echo h($product['Product']['picture_thumb']); ?>" alt="LF11CLASSIC"/>
								<span class="FjO azul"><?php echo h($product['Product']['name_blue']); ?><span class="rojodark"><?php echo h($product['Product']['name_red']); ?></span></span>
								<small><?php echo h($product['Product']['slogan']); ?></small>
							</a>
						</li>
						<?php endforeach; 
						
						/*<li class="menu-item-sub menu-item-sub1">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub2">
							<a href="#">
								<img src="images/productos/prod-c34max.png" alt="C34MAX"/>
								<small>Cortadora</small>
								<span class="FjO azul">C34<span class="rojodark">MAX</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub3">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub4">
							<a href="#">
								<img src="images/productos/prod-c34max.png" alt="C34MAX"/>
								<small>Cortadora</small>
								<span class="FjO azul">C34<span class="rojodark">MAX</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub5">
							<a href="#">
								<img src="images/productos/prod-c34max.png" alt="C34MAX"/>
								<small>Cortadora</small>
								<span class="FjO azul">C34<span class="rojodark">MAX</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub6">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub7">
							<a href="#">
								<img src="images/productos/prod-c34max.png" alt="C34MAX"/>
								<small>Cortadora</small>
								<span class="FjO azul">C34<span class="rojodark">MAX</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub8">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub9">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub10">
							<a href="#">
								<img src="images/productos/prod-c34max.png" alt="C34MAX"/>
								<small>Cortadora</small>
								<span class="FjO azul">C34<span class="rojodark">MAX</span></span>
							</a>
						</li>
						<li class="menu-item-sub menu-item-sub11">
							<a href="#">
								<img src="images/productos/prod-lf11classic.png" alt="LF11CLASSIC"/>
								<small>Cortadora</small>
								<span class="FjO azul">LF11<span class="rojodark">CLASSIC</span></span>
							</a>
						</li>*/ ?>
					</ul>
				</li>
                                <li class="menu-item menu-item4"><a href="<?php echo h(Router::url('/coch/articles', true)); ?>" class="FjO">NOVEDADES<span class="linea"></span></a></li>
                                <li class="menu-item menu-item5"><a href="<?php echo h(Router::url('/coch/contacto', true)); ?>" class="FjO">CONTACTO<span class="linea"></span></a></li>
                        </ul>
                </nav>
		<div class="clearfix"></div>
        </div>
</header>