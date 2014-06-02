<div class='row'>
	<div class='seccion col-xs-12'>
		<?php if (sizeof($productos) == 0) { ?>
		<div class='well' style='margin-top: 0.5em'>
			No hay productos registrados.
		</div>
		<?php } else { ?>
		<div class='table-responsive' style='margin-top: 0.5em'>
			<?php $this->load->helper('form'); $attrs = array('id' => 'form-comando') ?>
			<?=form_open(base_url().'admin/productos/comando', $attrs)?>
			</form>
			<table id='lista-productos' class='table table-condensed table-striped'>
				<tr>
					<?php if (!isset($hide_controls)) { ?>
					<th></th>
					<?php } ?>
					<th>ID</th>
					<th>Imagen</th>
					<th>Descripción</th>
					<th>Código</th>
					<th>Categoría</th>
					<th>Stock unitario</th>
					<th>Precio unitario</th>
					<?php if (!isset($hide_controls)) { ?>
					<th>¿Publicado?</th>
					<th>Acciones</th>
					<?php } ?>
				</tr>
				<?php foreach($productos as $producto) {?>
				<tr>
					<?php if (!isset($hide_controls)) { ?>
					<td><input name='seleccionados[]' type="checkbox" value='<?= $producto->id ?>'></td>
					<?php } ?>
					<td><?= $producto->id ?></td>
					<td><img class='width-sm img-responsive' src='<?= base_url().$producto->imagen ?>'></td>
					<td><?= $producto->descripcion ?></td>
					<td><?= $producto->codigo ?></td>
					<td><?= !is_null($producto->categoria) ? $producto->categoria->nombre : 'Ninguna'?></td>
					<td class='text-right'><?= $producto->stock_unitario ?></td>
					<td class='text-right'>$ <?= $producto->precio_unitario ?><br>x <?=!is_null($producto->medida) ? $producto->medida->nombre : 'pieza';?></td>
					<?php if (!isset($hide_controls)) { ?>
					<td>
						<div class='btn-group'>
							<a href='<?=base_url()?>admin/productos/publicar/<?=$producto->id?>' class='btn btn-sm btn-default <?= $producto->publicado ? "active" : "" ?>'>Si</a>
							<a href='<?=base_url()?>admin/productos/no_publicar/<?=$producto->id?>' class='btn btn-sm btn-default <?= $producto->publicado ? "" : "active" ?>'>No</a>
						</div>
					</td>
					<td>
						<div class='btn-group'>
							<a class='btn btn-default btn-sm' href='<?=base_url()?>admin/productos/modificar/<?=$producto->id?>'>
								<i class='glyphicon glyphicon-edit' title='Editar "<?= $producto->descripcion ?>"'></i>
							</a>
							<a class='btn btn-danger btn-sm confirmar' data-confirmar='¿Confirma que desea eliminar el producto "<?= $producto->descripcion ?>"?' href='<?=base_url()?>admin/productos/eliminar/<?=$producto->id?>'>
								<i class='glyphicon glyphicon-remove' title='Eliminar "<?= $producto->descripcion ?>"'></i>
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
