<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" 
			 data-target="#collapse1">
				<span class="sr-only">Mostrar navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url()?>admin">
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
			<ul class='nav navbar-nav navbar-right'>
				<li>
					<a href='<?=base_url()?>usuario'>
						<i class='glyphicon glyphicon-user'></i> 
						<?=$this->session->userdata('user_nombre')?>
					</a>
				</li>
				<li class='pull-right'><a href="<?=base_url()?>logout">Salir</a></li>
			</ul>
		</div>
	</div>
</nav>