<?php

function pedido_generate_pdf($context, $pedido) {
	$no = 0;
	$compras = array();
	foreach ($pedido->compras as $compra) {
		$compra_array = array();
		$compra_array['no.'] = ++$no;
		$compra_array['imagen'] = base_url().$compra->producto->imagen;
		$compra_array['codigo'] = $compra->producto->codigo;
		$compra_array['descripcion'] = $compra->producto->descripcion;
		$compra_array['variante'] = 'Ninguna';
		$compra_array['precio_unitario'] = '$'.number_format($compra->precio_unitario, 2);
		$compra_array['cantidad'] = $compra->cantidad_total;
		$compra_array['subtotal'] = '$'.number_format($compra->precio_bruto_total, 2);
		$compras[] = $compra_array;
	}

	$pdf_data = array(
		'usuario_nombre' => $pedido->usuario->nombres.' '.$pedido->usuario->apellido_paterno.' '.$pedido->usuario->apellido_materno,
		'usuario_departamento' => $pedido->usuario->departamento,
		'usuario_encargado' => $pedido->usuario->encargado_departamento,
		'pedido_fecha' => $pedido->created_at->format('d/m/Y'),
		'pedido_hora' => $pedido->created_at->format('H:i'),
		'compras' => $compras,
		'nombre_tienda' => NOMBRE_TIENDA
		);

	$context->load->helper( 'report_helper' );
	$pdf = new Report(new PedidoPDF_Generator());
	$pdf->set_data($pdf_data);
	$pdf->generate();
}

?>