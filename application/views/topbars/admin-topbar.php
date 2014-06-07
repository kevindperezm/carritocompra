<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" 
			 data-target="#collapse1">
				<span class="sr-only">Mostrar navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url()?>catalogo">
        <img class="app-logo" src="<?php echo base_url().APP_LOGO_PATH ?>" alt='app-logo'>
        <?=NOMBRE_TIENDA?>
      </a>
		</div>

		<div class="collapse navbar-collapse" id='collapse1'>
			<ul class="nav navbar-nav">
				<li><a href="<?=base_url()?>admin/pedidos">Pedidos</a></li>
				<li><a href="<?=base_url()?>admin/productos">Productos</a></li>
				<li><a href="<?=base_url()?>admin/usuarios">Usuarios</a></li>
				<li><a href="<?=base_url()?>admin/categorias">Categorias</a></li>
				<li><a href="<?=base_url()?>admin/medidas">Medidas</a></li>
			</ul>
  		<?php $this->load->view('topbars/topbar-derecha.php'); ?>
		</div>
	</div>
</nav>