<p class='font-size: small'>
	<b>Nota: </b>Los precios listados en la siguiente tabla son los precios
	que estaban vigentes en el momento en que este pedido fue elaborado. Los totales
	mostrados son calculados usando esos precios. Podrían diferir de los precios actuales de cada producto.
</p>
<?php if (isset($admin)) { ?>
<div class='acciones-bar row'>
	<div class='col-xs-12'>
		Estado del pedido: 
		<div class='btn-group'>
			<a href='<?=base_url()?>admin/pedidos/procesar/<?=$pedido->id?>' class='btn btn-sm btn-default <?= $pedido->procesado ? "active" : "" ?>'>Procesado</a>
			<a href='<?=base_url()?>admin/pedidos/no_procesar/<?=$pedido->id?>' class='btn btn-sm btn-default <?= $pedido->procesado ? "" : "active" ?>'>No procesado</a>
		</div>
	</div>
</div>
<?php } ?>
<div>
	<div class="table-responsive">
		<table class='table-bordered table-condensed table-striped' style="width: 100%">
			<tr>
				<th>Usuario</th>
				<th>Departamento</th> 
				<th>Encargado</th>
				<th>Fecha</th>
				<th>Hora</th>
				<?php if (isset($admin)) { ?>
				<th>Procesado: </th>
				<?php } ?>
			</tr>
			<tr>
				<td><?= $pedido->usuario->nombres.' '.$pedido->usuario->apellido_paterno.' '.$pedido->usuario->apellido_materno?></td>
				<td><?=$pedido->usuario->departamento?></td>
				<td><?=$pedido->usuario->encargado_departamento?></td>
				<td class='text-right'><?=$pedido->created_at->format('d \d\e M \d\e\l Y')?></td>
				<td class='text-right'><?=$pedido->created_at->format('H:i')?></td>
				<?php if (isset($admin)) { ?>
				<td class='text-right'><?= $pedido->procesado > 0 ? 'Si' : 'Aún no' ?></td>
				<?php } ?>
			</tr>
		</table>
	</div>
	<?php $total = 0 ?>
	<div class="table-responsive">
		<table class='table-striped table-condensed table-bordered' style="min-width: 100%">
			<tr>
				<th>Imagen</th>
				<th>Código</th>
				<th>Descripción</th>
				<th>Variante</th>
				<th>Precio unitario</th>
				<th>Cantidad</th>
				<th>Subtotal</th>
			</tr>
			<?php foreach ($pedido->compras as $compra) { ?>
			<tr>
				<td><img class='img-responsive producto-imagen' src='<?=base_url().$compra->producto->imagen?>' alt='Imagen del producto'></td>
				<td><?=$compra->producto->codigo?></td>
				<td><?=$compra->producto->descripcion?></td>
				<td><?=mostrarVariante($compra)?></td>
				<td class='text-right'>$ <?=number_format($compra->precio_unitario, 2)?><br>x <?=!is_null($compra->producto->medida) ? $compra->producto->medida->nombre : 'pieza';?></td>
				<td class='text-right'><?=$compra->cantidad_total?></td>
				<?php $subtotal = $compra->precio_bruto_total ?>
				<td class='text-right'>$ <?=number_format($subtotal, 2)?></td>
				<?php $total += $subtotal ?>
			</tr>
			<?php } ?>
			<tr>
				<td class="text-right" colspan="6"><h3>Total:</h3></td>
				<td class="text-right"><h3>$ <?=number_format($total, 2)?> M.N.</h3></td>
			</tr>
		</table>
	</div>
</div>