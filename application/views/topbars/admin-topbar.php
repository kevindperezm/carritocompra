<?php
/*
 | 
 | Barra de navegación de interfaz de administrador.
 | Proporciona vínculos para administrar los contenidos
 | del catálogo y los pedidos generados por los clientes.
 | También brinda un botón de acceso al catálogo, uno al
 | carrito de compra y un botón para cerrar sesión.
 |
 */
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse1">
				<span class="sr-only">Mostrar navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url()?>admin"><?=NOMBRE_TIENDA?></a>
		</div>

		<div class="collapse navbar-collapse" id='collapse1'>
			<ul class="nav navbar-nav">
				<?php 
				$uri = explode('/', uri_string());
				sizeof($uri) > 1 ? $uri = $uri[1] : $uri = $uri[0];
				?>
				<?php # TODO: ¿Por qué 'Inicio' no se marca como activo? ?>
				<li <?= $uri == '' or $uri == 'admin' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin">Inicio</a></li>
				<?=$this->load->view('topbars/boton-catalogo')?>
				<li <?= $uri == 'pedidos' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin/pedidos">Pedidos</a></li>
				<li <?= $uri == 'productos' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin/productos">Productos</a></li>
				<li <?= $uri == 'usuarios' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin/usuarios">Usuarios</a></li>
				<li class='dropdown'>
 					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Más <b class="caret"></b></a>
 					<ul class='dropdown-menu'>
						<li <?= $uri == 'categorias' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin/categorias">Categorias</a></li>
						<li <?= $uri == 'medidas' ? 'class="active"' : '' ?>><a href="<?=base_url()?>admin/medidas">Medidas</a></li>
 					</ul>
 				</li>
			</ul>
			<?=$this->load->view('topbars/topbar-derecha')?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>