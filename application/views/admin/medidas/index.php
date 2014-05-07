<div class='container-fluid'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3><?= $titulo ?></h3>
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
			<a href='<?=base_url()?>admin/medidas/nuevo'>
				<button class='btn btn-primary'>Nueva medida</button>
			</a>
			<div class='dropdown' style='display: inline-block !important'>
				<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Seleccionar <span class="caret"></span></button>
				<ul class='dropdown-menu'>
					<li id='seleccionar-todos' data-target='#lista-medidas'><a href='#' class='menuitem'>Todos</a></li>
					<li id='seleccionar-ninguno' data-target='#lista-medidas'><a href='#' class='menuitem'>Ninguno</a></li>
				</ul>
			</div>
			<div class='dropdown' style='display: inline-block !important'>
				<button class='btn btn-default dropdown-toggle' data-toggle='dropdown'>Con los seleccionados <span class="caret"></span></button>
				<ul class='dropdown-menu'>
					<li>
						<a href='#' class='menuitem confirmar comando' data-comando='eliminar-todos' data-confirmar='¿Confirma que desea eliminar los medidas seleccionados?'>
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
	<div class='row'>
		<div class='seccion col-xs-12'>
			<?php if (sizeof($medidas) == 0) { ?>
			<div class='well' style='margin-top: 0.5em'>
				No hay medidas guardadas.
			</div>
			<?php } else { ?>
			<div class='table-responsive' style='margin-top: 0.5em'>
				<?php $this->load->helper('form'); $attrs = array('id' => 'form-comando') ?>
				<?=form_open(base_url().'admin/medidas/comando', $attrs)?>
				</form>
				<table id='lista-medidas' class='lista table table-condensed table-bordered table-striped'>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Nombre</th>
						<th>Creada el</th>
						<th>Modificada el</th>
						<th>Acciones</th>
					</tr>
					<?php foreach ($medidas as $medida) { ?>
					<tr>
						<td><input type="checkbox" value='<?= $medida->id ?>'></td>
						<td><?= $medida->id ?></td>
						<td><b><?= ucfirst($medida->nombre) ?></b></td>
						<td><?= $medida->created_at->format('d-M-Y H:i') ?></td>
						<td><?= $medida->updated_at->format('d-M-Y H:i') ?></td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-default btn-sm' href='<?=base_url()?>admin/medidas/modificar/<?=$medida->id?>'>
									<i class='glyphicon glyphicon-edit' title='Editar "<?= $medida->nombre ?>"'></i>
								</a>
								<a class='btn btn-danger btn-sm confirmar' href='<?=base_url()?>admin/medidas/eliminar/<?=$medida->id?>' data-confirmar='¿Confirma que desea eliminar la medida "<?= $medida->nombre ?>"? Borrar una medida dejará a sus productos sin medida.'>
									<i class='glyphicon glyphicon-remove' title='Eliminar "<?= $medida->nombre ?>"'></i>
								</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-12 text-right'>
			<ul class='pagination'>
				<?= $this->pagination->create_links() ?>
			</ul>
		</div>
	</div>
</div>