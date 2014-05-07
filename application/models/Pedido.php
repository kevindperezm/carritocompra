<?php

class Pedido extends ActiveRecord\Model {
	static $belongs_to = array(
		array('usuario')
	);

	static $has_many = array(
		array('detalles'),
		array('compras', 
			'through' => 'detalles',
			'conditions' => array('concretada > 0'),
			'select' => '*, sum(precio_bruto) as precio_bruto_total, sum(cantidad) as cantidad_total',
			'group' => 'usuario_id, producto_id, variante_id'
		)
	);
}

?>