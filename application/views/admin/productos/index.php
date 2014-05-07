<div class='container-fluid'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Administrar productos</h3>
		</div>
	</div>
	<?php if (isset($flash)) { ?>
	<div class="row">
		<div class='col-xs-12 alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
			<button class='close' data-dismiss='alert'>x</button>
			<?= $mensaje ?>
		</div>
	</div>	
	<?php } ?>
	<div class='row'>

		<div class='acciones-bar col-sm-8'>

			<a href='<?=base_url()?>admin/productos/nuevo'>
				<button class='btn btn-primary'>Nuevo producto</button>
			</a>
			<div class='dropdown' style='display: inline-block !important'>
				<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
					<?=$filtros[$filtro][0]?> <span class="caret"></span>
				</button>
				<ul class='dropdown-menu'>
					<?php foreach ($filtros as $clave => $valor) { ?>
					<li ><a href='<?=base_url()?>admin/productos/filtro/<?=$clave?>' class='menuitem'><?=$valor[0]?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class='dropdown' style='display: inline-block !important'>
				<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Seleccionar <span class="caret"></span></button>
				<ul class='dropdown-menu'>
					<li id='seleccionar-todos' data-target='#lista-productos'><a href='#' class='menuitem'>Todos</a></li>
					<li id='seleccionar-ninguno' data-target='#lista-productos'><a href='#' class='menuitem'>Ninguno</a></li>
				</ul>
			</div>
			<div class='dropdown' style='display: inline-block !important'>
				<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Con los seleccionados <span class="caret"></span></button>
				<ul class='dropdown-menu'>
					<li>
						<a href='#' class='menuitem comando' data-comando='publicar-todos'>Publicar seleccionados</a>
					</li>
					<li>
						<a href='#' class='menuitem comando' data-comando='ocultar-todos'>Ocultar seleccionados</a>
					</li>
					<li>
						<a href='#' class='menuitem confirmar comando' data-comando='eliminar-todos' data-confirmar='¿Confirma que desea eliminar los usuarios seleccionados?'>
							Eliminar seleccionados
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class='col-sm-4 text-right'>
			<ul class='pagination'>
				<?= $this->pagination->create_links() ?>
			</ul>
		</div>
	</div>
	<?=$this->load->view('admin/productos/tabla')?>
	<div class='row'>
		<div class='col-xs-12 text-right'>
			<ul class='pagination'>
				<?= $this->pagination->create_links() ?>
			</ul>
		</div>
	</div>
</div>
	