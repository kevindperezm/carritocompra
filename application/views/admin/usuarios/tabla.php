<div class='row'>
	<div class='seccion col-xs-12'>
		<?php if (sizeof($usuarios) == 0) { ?>
		<div class='well' style='margin-top: 0.5em'>
			No hay usuarios registrados.
		</div>
		<?php } else { ?>
		<div class='table-responsive' style='margin-top: 0.5em'>
			<?php $this->load->helper('form'); $attrs = array('id' => 'form-comando') ?>
			<?=form_open(base_url().'admin/usuarios/comando', $attrs)?>
		</form>
		<table id='lista-usuarios' class='lista table table-condensed table-bordered table-striped'>
			<tr>
				<?php if (!isset($hide_controls)) { ?>
				<th></th>
				<?php } ?>
				<th>ID</th>
				<th>Usuario</th>
				<th>Nombre(s)</th>
				<th>Apellido paterno</th>
				<th>Apellido materno</th>
				<th>Departamento</th>
				<th>Cargo</th>
				<th>Rol</th>
				<?php if (!isset($hide_controls)) { ?>
				<th>¿Activado?</th>
				<th>Acciones</th>
				<?php } ?>
			</tr>
			<?php foreach ($usuarios as $usuario) { ?>
			<tr>
				<?php if (!isset($hide_controls)) { ?>
				<td><input type="checkbox" value='<?= $usuario->id ?>'></td>
				<?php } ?>
				<td><?= $usuario->id ?></td>
				<td><b><?= $usuario->nombre_usuario ?></b></td>
				<td><?= $usuario->nombres ?></td>
				<td><?= $usuario->apellido_paterno ?></td>
				<td><?= $usuario->apellido_materno ?></td>
				<td><?= $usuario->departamento ?></td>
				<td><?= $usuario->cargo ?></td>
				<td><?= $GLOBALS['ROLES_USUARIO'][$usuario->rol] ?></td>
				<?php if (!isset($hide_controls)) { ?>
				<td>
					<div class='btn-group'>
						<a href='<?=base_url()?>admin/usuarios/activar/<?=$usuario->id?>' class='btn btn-sm btn-default <?= $usuario->activado ? "active" : "" ?>'>Si</a>
						<a href='<?=base_url()?>admin/usuarios/desactivar/<?=$usuario->id?>' class='btn btn-sm btn-default <?= $usuario->activado ? "" : "active" ?>'>No</a>
					</div>
				</td>
				<td>
					<div class='btn-group'>
						<a class='btn btn-default btn-sm' href='<?=base_url()?>admin/usuarios/modificar/<?=$usuario->id?>'>
							<i class='glyphicon glyphicon-edit' title='Editar "<?= $usuario->nombre_usuario ?>"'></i>
						</a>
						<a class='btn btn-danger btn-sm confirmar' href='<?=base_url()?>admin/usuarios/eliminar/<?=$usuario->id?>' data-confirmar='¿Confirma que desea eliminar el usuario "<?= $usuario->nombre_usuario ?>"?'>
							<i class='glyphicon glyphicon-remove' title='Eliminar "<?= $usuario->nombre_usuario ?>"'></i>
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