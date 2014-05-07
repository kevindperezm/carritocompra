<div class='row'>
	<div class='col-xs-12'>
		<h2><?=$titulo?></h2>
	</div>
</div>
<div class='row'>
	<div class='col-xs-12 col-sm-8'>
		<?php $this->load->helper('form'); ?>
		<?=form_open(base_url().$busquedaUrl)?>
			<div class='input-group'>
				<span class='input-group-addon'>Buscar</span>
				<input type="text" name='buscar' placeholder="Todo o parte del nombre del producto" class="form-control" <?= isset($buscar) ? 'value="'.$buscar.'"' : '' ?> required/>
				<span class='input-group-btn'><button type='submit' class="btn btn-primary" style='margin:0'><i class='glyphicon glyphicon-search'></i></button></span>
			</div>
		</form>
	</div>
	<div class='col-xs-12 col-sm-4 text-right'>
		<ul class='pagination'>
			<?= $this->pagination->create_links() ?>
		</ul>
	</div>
</div>
<?php if (isset($flash)) { ?>
<div class="row">
	<div class='col-xs-12'>
		<div class='alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
			<button class='close' data-dismiss='alert'>x</button>
			<?= $mensaje ?>
		</div>
	</div>
</div>	
<?php } ?>
<hr>
<?php if (sizeof($productos) <= 0) { ?>
<div class='row'>
	<div class='col-xs-12'>
		<div class='alert alert-info'>
			No hay productos para mostrar.
		</div>
	</div>
</div>
<?php } else { ?>
<div class="table-responsive">
	<table class="table-condensed table-bordered table-striped">
		<tr>
			<th>
				Imagen
			</th>
			<th>
				Descripcion
			</th>
			<th>
				Código
			</th>
			<th>
				Precio
			</th>
			<!-- <th>
				Existencias
			</th> -->
			<!-- <th>
				Cantidad a pedir
			</th> -->
			<th>
				Carrito
			</th>
		</tr>
			<?php
				$this->load->helper('form');
				foreach ($productos as $objeto) {
					echo "<tr>";
						echo "<td>";
							echo "<a href='".base_url()."producto/$objeto->id'><img class='img-responsive producto-imagen' src='".base_url().$objeto->imagen."' alt='Imagen de producto'></a>";
						echo "</td>";
						echo "<td>";
							echo "<b>".$objeto->descripcion."</b>";
						echo "</td>";
						echo "<td class='text-right'>";
							echo $objeto->codigo;
						echo "</td>";
						echo "<td class='text-right'>";
							echo "<span class='texto-rojo' style='font-size: 1.6em'>$	".number_format((float)$objeto->precio_unitario, 2, '.', '')."</span><br>x ";
							echo !is_null($objeto->medida) ? $objeto->medida->nombre : 'pieza';
						echo "</td>";
						echo "<td class='text-center'>";
							echo "<a style='margin-top: 0' href='".base_url()."producto/$objeto->id' class='btn btn-primary'><i class='glyphicon glyphicon-list'></i> Ver detalles</button>";
						echo "</td>";
					echo "</tr>";
				}
			?>
	</table>
</div>
<?php } ?>
<!-- <hr> -->
<div class='row'>
	<div class='col-xs-12 text-right'>
		<ul class='pagination'>
			<?= $this->pagination->create_links() ?>
		</ul>
	</div>
</div>