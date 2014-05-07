<div class='row'>
	<div class='col-xs-12'>
		<h2>Carrito de compra</h2>
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
<?php if (sizeof($compras) <= 0) { ?>
<div class='row'>
	<div class='col-xs-12'>
		<div class='alert alert-info'>
			Su carrito de compra está vacío.
		</div>
	</div>
</div>
<?php } else { ?>
<div class='row'>
	<div class='col-xs-12 col-sm-6 acciones-bar'>
		<button class='btn btn-danger' data-toggle='modal' data-target='#dialogo'>Confirmar</button>
		<div class="modal fade" id='dialogo'>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Confirmar compra</h4>
					</div>
					<div class="modal-body">
						<p>
							¿Está seguro que desea confirmar como compra el contenido actual de su carrito?
							Si es así haga clic en <b>Confirmar</b>. De lo contrario, haga clic en <b>Cancelar</b>
							o cierre este cuadro de diálogo.
						</p>
						<p>
							Si desea hacer alguna observación, puede hacerlo en el siguiente espacio:<br>
							<?php $this->load->helper('form') ?>
							<?= form_open(base_url().'carrito/confirmar', array('id' => 'direccion-pedido')) ?>
								<textarea class='form-control' name='observaciones'></textarea>
							</form>
						</p>
						<?php $this->load->helper('form') ?>
						<style>
						.input-group {padding-top: 0.5em}
						textarea {max-width: 557px;}
						</style>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-danger" value='Confirmar' form='direccion-pedido'>
					</div>
				</div>
			</div>
		</div>
		<a href='<?=base_url()?>carrito/vaciar' class='btn btn-default confirmar' data-confirmar='¿Seguro que desea vaciar su carrito de compra? Esto borrará todos los productos que ha puesto en él hasta el momento.'>
			Vaciar
		</a>
	</div>
	<div class='col-xs-12 col-sm-6 text-right'>
		<ul class='pagination'>
			<?= $this->pagination->create_links() ?>
		</ul>
	</div>
</div>
<div class='table-responsive'>
	<table class="table-condensed table-striped table-bordered">
		<tr>
			<th>
				Imagen
			</th>

			<th>
				Descripcion
			</th>

			<th class='text-right'>
				Variante
			</th>

			<th class='text-right'>
				Precio unitario
			</th>

			<th class='text-right'>
				Cantidad
			</th>

			<th class='text-right'>
				Precio 
			</th>
			<th style='width: 2em'></th>
		</tr>
		<?php
		foreach ($compras as $objeto) {
			echo "<tr>";
			echo "<td>";
			echo "<img class='img-responsive producto-imagen' src=".base_url().$objeto->producto->imagen." alt='Imagen de producto'>";
			echo "</td>";
			echo "<td>";
			echo $objeto->producto->descripcion."<br>";
			echo "</td>";
			echo "<td>";
				echo mostrarVariante($objeto);
			echo "</td>";
			echo "<td class='text-right'>";
			echo '$ '.number_format($objeto->producto->precio_unitario,2).'<br>x ';
			echo !is_null($objeto->producto->medida) ? $objeto->producto->medida->nombre : 'pieza';; // Muestra el precio más reciente del producto .
			echo "</td>";
			echo "<td class='text-right'>";
			echo $objeto->cantidad_agrupado;
			echo "</td>";
			echo "<td class='text-right'>";
			echo '$ '.number_format($objeto->cantidad_agrupado * $objeto->producto->precio_unitario, 2);
			echo "</td>";
			echo '<td class="text-center">';
			echo "
			<a href='".base_url()."carrito/remover/$objeto->id' 
				class='btn btn-sm btn-default confirmar' 
				data-confirmar='¿Está seguro que desea remover este producto de su carrito? Si más tarde desea recuperarlo tendrá que volver a añadirlo.'
				title='Remover del carrito'
				>
				<i class='glyphicon glyphicon-remove'></i>
			</a>
			";
			echo '</td>';
			echo "</tr>";
		} ?>
	</table>
</div>
<div class='row'>
	<div class='col-xs-12 text-right'>
		<ul class='pagination'>
			<?= $this->pagination->create_links() ?>
		</ul>
	</div>
</div>
<div class='row'>
	<div class='col-xs-12 text-right texto-rojo btn-lg'>
		<b>Total: $ <?=number_format($total, 2)?> M.N.</b>
	</div>
</div>
<?php } ?>