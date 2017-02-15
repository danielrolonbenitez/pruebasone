<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Coch');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('smoothness/jquery-ui-1.10.2.custom.min');
		echo $this->Html->css('jquery.fancybox-1.3.4');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-1.9.1.min');
		echo $this->Html->script('jbrowser.emulation.js');
		echo $this->Html->script('jquery-ui-1.10.2.custom.min');
		echo $this->Html->script('jquery.easing-1.3.pack');
		echo $this->Html->script('jquery.fancybox-1.3.4.pack');
	?>
	<!--[if lt IE 9]><?php echo $this->Html->css('cake.generic.ie7'); ?><![endif]-->
</head>
<body>
	<div id="container">
		<div id="top-cap"></div>
		<div id="header">
			<div class="logo">Coch</div>
			<div class="title">Panel de administración</div>
			<div class="main-menu">
				<?php if($logged_user) : ?>
				<div class="current-user">
					<?php echo h($logged_user['username']); ?>
					<span class="arrow"></span>
					<ul class="user-menu">
						<li><a href="" class="change-password">Cambiar contraseña</a></li>
						<li class="hr">&nbsp;</li>
						<li><?php 
						echo $this->Html->link('Cerrar sesión', array('controller' => 'Users', 'action' => 'logout'), array('class' => 'logout'));
						?></li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div id="main">
			<ul class="menu-left">
				<li>
					<strong>Listado</strong>
					<ul>
						<li><a href="<?php echo h(Router::url('/products/', true)); ?>">Productos</a></li>
						<li><a href="<?php echo h(Router::url('/articles/', true)); ?>">Novedades</a></li>
						<?php /*<li><a href="<?php echo h(Router::url('/newsletter', true)); ?>">Generar newsletter</a></li>*/ ?>
						<li><a href="<?php echo h(Router::url('/newsletter/csv', true)); ?>">Suscriptos al newsletter</a></li>
						<li><a href="<?php echo h(Router::url('/pages/', true)); ?>">Sección Empresa</a></li>
					</ul>
				</li>
			</ul>
			<div id="content">

				<?php echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
