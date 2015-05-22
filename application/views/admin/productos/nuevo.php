<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/colorpicker/css/colorpicker.css">
<script src='<?=base_url()?>public/colorpicker/js/colorpicker.js'></script>

<?php $this->load->helper('form') ?>
<style>
.input-group {
	margin: 0.7em auto;
}
</style>

<div class='container-fluid'>
	<?php echo $this->load->view('parciales/mensaje_exitoso', true) ?>
	<div class='row'>
		<div class='col-xs-12' style='margin: 1em auto'>
			<a href='<?=base_url()?>admin/productos' class='btn btn-default' style='margin-right: 0.5em'><i class='glyphicon glyphicon-chevron-left'></i> Atrás</a>
			<h3 style="display:inline"><?=$titulo?></h3>
		</div>
	</div>
	<?php if (!empty($falla)) { ?>
	<div class="row">
		<div class='col-xs-12'>
			<div class='alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
				<button class='close' data-dismiss='alert'>x</button>
				<p><?=$mensaje_error?></p>
				<?=validation_errors()?>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php
	$E = (isset($editar_producto) and $this->input->post() == null);
	?>

	<div class='row'>
		<div class="col-xs-12">
			<div class='well'>
				<?php
				$attrs = array('class' => 'form', 'id' => 'form-producto');
				$this->load->helper('form');
				?>
				<?= form_open_multipart(base_url().'admin/productos/nuevo', $attrs) ?>
					<div class='row'>
						<?php if (isset($editar_producto)) { ?>
						<div class='col-xs-12 col-md-6' style='min-height: 16em !important'>
							<label class='input-group-addon'>Imagen actual</label>
							<div class='well text-center'>
								<img style='width: 100%; max-width: 15em;border-radius: 4px' src="<?=base_url().$editar_producto->imagen?>">
							</div>
						</div>
						<?php } ?>
						<div class='col-xs-12 col-md-6'>
							<?php if (isset($editar_producto)) { ?>
							<small>Si no desea modificar la imagen, deje en blanco el siguiente campo.</small><br>
							<?php } ?>
							<div class='input-group'>
								<label class='input-group-addon'>Imagen del producto</label>
								<input type="file" class='form-control' name="imagen" <?=isset($editar_producto) ? '' : 'required'?>>
							</div>
							<small>Tamaño máximo: 800 x 800, 2 MB</small>
							<div class='input-group'>
								<label class='input-group-addon'>Descripción del producto</label>
								<input type="text" name="descripcion" value='<?=$E ? $editar_producto->descripcion : set_value('descripcion')?>' class="form-control">
							</div>
							<div class='input-group'>
								<label class='input-group-addon'>Código del producto</label>
								<input type="text" name="codigo" value='<?=$E ? $editar_producto->codigo : set_value('codigo')?>' class='form-control'>
							</div>

							<div class="container-fluid admin-detalles-variantes" style='padding-top: 0.5em'>
								<span style='padding-top: 0.5em; display: inline-block'>¿Este producto tiene variantes?</span>
								<div class='btn-group' data-toggle='buttons' style='float: right'>
									<?php $v = ($this->input->post('tiene-variantes') === '1'); ?>
									<label class='btn btn-default <?=$v ? 'active' : ''?>'>
										<input type="radio" name='tiene-variantes' id='variante-si' value='1' <?= $v ? 'checked="checked"' : '' ?>>Si
									</label>
									<label class='btn btn-default <?=$v ? '' : 'active'?>'>
										<input type="radio" name='tiene-variantes' id='variante-no' value='2' <?= $v ? '' : 'checked="checked"' ?>>No
									</label>
								</div>
								<div id='detalles-variantes' style='margin-top: 1.8em'>
									<?php
									$i = 0;
									do { ?>
										<?php
										$tv = $this->input->post('tipo-variante');
										$tv = $tv[$i];
										if ($i == 0 or $tv != 0) { ?>
											<div id='variantes-clonable'>
												<div class='input-group'>
													<label class='input-group-addon'>Tipo de variante</label>
													<select class="form-control tipo-variante" name='tipo-variante[]'>
														<option value='0'>Ninguna</option>
														<?php foreach ($GLOBALS['TIPOS_VARIANTE'] as $valor => $clave) { echo $tv;?>
															<option value='<?=$valor?>' <?=$tv == $valor ? 'selected="selected"' : ''?>><?=$clave?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										<?php }
										if ($tv != 0) {
											$valor = $this->input->post('valor-variante');
											$valor = $valor[$i]; ?>
											<div class="input-group valor-variante-detalles">
												<input class="valor-variante" type="hidden" name="valor-variante[]" value="<?=$valor?>"> <?php
												switch ($tv) {
													case VARIANTE_COLORES: ?>
														<label class="input-group-addon">Color</label>
														<span class="form-control color" style='background: <?=$valor?>'></span>
														<div class="input-group-btn">
															<button class="btn btn-default colorbtn" data-color="<?=$valor?>">Seleccionar color</button>
														</div> <?php
														break;
												} ?>
											</div>
										<?php
										} ?>
									<?php
										$i++;
									} while($v and $i < sizeof($this->input->post('tipo-variante'))); ?>
								</div>
								<button id='nueva-variante' class='btn btn-default pull-right' style='margin-bottom: 0.5em'><i class='glyphicon glyphicon-plus-sign'></i> Nueva variante</button>
							</div>

						</div>
						<div class='col-xs-12 col-md-6'>
							<div class='input-group'>
								<label class='input-group-addon'>Cantidad en almacén</label>
								<input type="number" name="stock" value='<?=$E ? $editar_producto->stock_unitario : set_value('stock')?>' class='form-control'>
							</div>
							<div class='input-group'>
								<span class='input-group-addon'>Precio unitario <i class='glyphicon glyphicon-usd'></i></span>
								<input type="text" name="precio_unitario" value='<?=$E ? $editar_producto->precio_unitario : set_value('precio_unitario')?>' class='form-control'>
								<span class='input-group-addon'>pesos</span>
							</div>
							<div class='input-group'>
								<label class='input-group-addon'>Categoría del producto</label>
								<select class="form-control" name='categoria'>
									<option value='0'>Seleccionar categoría</option>
									<?php foreach (Categoria::all(array('order' => 'nombre ASC')) as $cat) { ?>
										<option value='<?=$cat->id?>'
										<?php
										if ($E and !is_null($editar_producto->categoria)) {
											if ($cat->id == $editar_producto->categoria->id) echo 'selected="selected"';
										} else {
											if ($this->input->post('categoria') == $cat->id) echo 'selected="selected"';
										}
										?>
										><?=$cat->nombre?></option>
									<?php } ?>
									?>
								</select>
							</div>
							<div class='input-group'>
								<label class='input-group-addon'>Medida de venta</label>
								<select class="form-control" name='medida'>
									<option value='0'>Seleccionar medida</option>
									<?php foreach (Medida::all(array('order' => 'nombre ASC')) as $medida) { ?>
										<option value='<?=$medida->id?>'
										<?php
										if ($E and !is_null($editar_producto->medida)) {
											if ($medida->id == $editar_producto->medida->id) echo 'selected="selected"';
										} else {
											if ($this->input->post('medida') == $medida->id) echo 'selected="selected"';
										}
										?>
										><?=ucfirst($medida->nombre)?></option>
									<?php } ?>
									?>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class='row' style='margin-top: -1.4em'>
				<div class='col-xs-12 col-md-6'>
					<button type='submit' class="btn btn-primary btn-lg" form='form-producto'>Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src='<?=base_url()?>public/js/admin-variantes.js'></script>