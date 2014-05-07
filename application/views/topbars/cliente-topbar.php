<?php
/*
 | 
 | Barra de navegación de la interfaz para el cliente.
 | Contiene vínculos que el cliente puede usar para 
 | moverse por el sitio, un botón para acceder al 
 | carrito de compra y un botón para cerrar sesión.
 */
 ?>
 <nav class="navbar navbar-default navbar-fixed-top navcolor" role="navigation">
 	<div class="container-fluid">
 		<div class="navbar-header">
 			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse1">
 				<span class="sr-only">Mostrar navegación</span>
 				<span class="icon-bar"></span>
 				<span class="icon-bar"></span>
 				<span class="icon-bar"></span>
 			</button>
 			<a class="navbar-brand" href="<?=base_url()?>catalogo"><?=NOMBRE_TIENDA?></a>
 		</div>

 		<div class="collapse navbar-collapse" id='collapse1'>
 			<ul class="nav navbar-nav">
 				<?=$this->load->view('topbars/boton-catalogo')?>
 			</ul>
 			<?=$this->load->view('topbars/topbar-derecha')?>
		</div>
 	</div>
 </nav>
