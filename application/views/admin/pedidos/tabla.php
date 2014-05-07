<div class='row'>
	<div class='seccion col-xs-12'>
		<?php if (sizeof($pedidos) == 0) { ?>
		<div class='well' style='margin-top: 0.5em'>
			No hay pedidos registrados.
		</div>
		<?php } else { ?>
		<div class='table-responsive' style='margin-top: 0.5em'>
			<?php $this->load->helper('form'); $attrs = array('id' => 'form-comando') ?>
			<?=form_open(base_url().'admin/pedidos/comando', $attrs)?>
		</form>
		<table id='lista-pedidos' class='lista table table-condensed table-striped table-bordered'>
			<tr>
				<?php if (!isset($hide_controls)) { ?>
				<th></th>
				<?php } ?>
				<th>No.</th>
				<th>Cliente</th>
				<th>Departamento</th>
				<th>Encargado</th>
				<th>Observaciones</th>
				<th>Fecha</th>
				<th>Hora</th>
				<?php if (!isset($hide_controls)) { ?>
				<th>¿Procesado?</th>
				<th>Acciones</th>
				<?php } ?>
			</tr>
			<?php foreach ($pedidos as $pedido) { ?>
			<tr>
				<?php if (!isset($hide_controls)) { ?>
				<td><input type="checkbox" value='<?= $pedido->id ?>'></td>
				<?php } ?>
				<td><?= $pedido->id ?></td>
				<td><?= $pedido->usuario->nombres.' '.$pedido->usuario->apellido_paterno.' '.$pedido->usuario->apellido_materno?></td>
				<td><?= $pedido->usuario->departamento ?></td>
				<td><?= $pedido->usuario->encargado_departamento ?></td>
				<td><?= $pedido->observaciones ?></td>
				<td><?= $pedido->created_at->format('d-M-Y') ?></td>
				<td><?= $pedido->created_at->format('H:i') ?></td>
				<?php if (!isset($hide_controls)) { ?>
				<td>
					<div class='btn-group'>
						<a href='<?=base_url()?>admin/pedidos/procesar/<?=$pedido->id?>' class='btn btn-sm btn-default <?= $pedido->procesado ? "active" : "" ?>'>Si</a>
						<a href='<?=base_url()?>admin/pedidos/no_procesar/<?=$pedido->id?>' class='btn btn-sm btn-default <?= $pedido->procesado ? "" : "active" ?>'>No</a>
					</div>
				</td>
				<td>
					<div class='btn-group'>
						<a class='btn btn-default btn-sm' href='<?=base_url()?>admin/pedidos/detalles/<?=$pedido->id?>'>
							<i class='glyphicon glyphicon-list-alt' title='Detalles del pedido  #"<?= $pedido->id ?>"'></i>
						</a>
						<a class='btn btn-danger btn-sm confirmar' data-confirmar='¿Confirma que desea eliminar el pedido #<?= $pedido->id ?>?' href='<?=base_url()?>admin/pedidos/eliminar/<?=$pedido->id?>'>
							<i class='glyphicon glyphicon-remove' title='Eliminar pedido #"<?= $pedido->id ?>"'></i>
						</a>
					</div>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
	</div>
	<?php } ?>
</div>
</div>