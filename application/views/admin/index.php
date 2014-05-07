<style>
	.btn {
		margin: 0.3em auto;
	}
</style>
<div class='container-fluid'>
	<div class='row' style='margin-top: 2em'>
		<div class='col-xs-12 col-sm-5'>
			<h1>Bienvenido, <b><?=$this->session->userdata('user_nombre')?></b> </h1>
			<p>
				Haga clic en alguno de los botones para ir a la página de administración
				que corresponde.
			</p>
		</div>
		<div class='col-xs-12 col-sm-7'>
			<h4>Navegación</h4>
			<div class='well well-lg'>
				<div class='row'>
					<div class='col-xs-12 col-sm-6'>
						<a class='btn btn-default btn-lg btn-block ' href='<?=base_url()?>catalogo'>
							<i class='glyphicon glyphicon-shopping-cart'></i> Catalogo
						</a>
					</div>
					<div class='col-xs-12 col-sm-6'>
						<a class='btn btn-default btn-lg btn-block' href='<?=base_url()?>admin/pedidos'>
							<i class='glyphicon glyphicon-list-alt'></i> Pedidos
						</a>
					</div>
					<!-- <div class='col-xs-12 col-sm-6'>
						<a class='btn btn-default btn-lg btn-block' href='<?=base_url()?>admin/productos'>
							<i class='glyphicon glyphicon-list'></i> Categorías
						</a>
					</div> -->
					<div class='col-xs-12 col-sm-6'>
						<a class='btn btn-default btn-lg btn-block' href='<?=base_url()?>admin/productos'>
							<i class='glyphicon glyphicon-list-alt'></i> Productos
						</a>
					</div>
					<div class='col-xs-12 col-sm-6'>
						<a class='btn btn-default btn-lg btn-block' href='<?=base_url()?>admin/usuarios'>
							<i class='glyphicon glyphicon-user'></i> Usuarios
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-12 col-md-6'>
				<h4>Últimos 10 pedidos recibidos</h4>
				<div class='well'>
					<?php
					$data['pedidos'] = Pedido::all(array(
						'order' => 'created_at desc',
						'limit' => '10'
					));
					$data['hide_controls'] = TRUE;
					$this->load->view('admin/pedidos/tabla', $data);
					?>
				</div>
				<h4>Últimos 10 usuarios registrados</h4>
				<div class='well'>
					<?php
					$data['usuarios'] = Usuario::all(array(
						'order' => 'created_at desc',
						'limit' => '10'
					));
					$data['hide_controls'] = TRUE;
					$this->load->view('admin/usuarios/tabla', $data);
					?>
				</div>
			</div>
		<!-- </div> -->
		<!-- <div class='row'> -->
			<div class='col-xs-12 col-md-6'>
				<h4>Últimos 10 productos publicados</h4>
				<div class='well'>
					<?php
					$data['productos'] = Producto::all(array(
						'conditions' => array('publicado > 0'),
						'order' => 'id desc, updated_at desc',
						'limit' => '10'
					));
					$data['hide_controls'] = TRUE;
					$this->load->view('admin/productos/tabla', $data);
					?>
				</div>
			</div>
		<!-- </div> -->
		<!-- <div class='row'> -->
			<!-- <div class='col-xs-12 col-md-6 col-xl-4'>
				
			</div> -->
		</div>
	</div>
</div>
