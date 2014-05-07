<?php

class Detalle extends ActiveRecord\Model {
	static $table_name = 'pedidos_compras';
	static $belongs_to = array(
		array('pedido'),
		array('compra')
	);
}

?>