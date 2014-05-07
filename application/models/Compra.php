<?php


class Compra extends ActiveRecord\Model{
	static $belongs_to = array(
		array('usuario'),
		array('producto'),
		array('variante')
	);

	static $has_one =array(
		array('pedido', 'through' => 'detalles')
	);

	static $has_many = array(
		array('detalles')
	);

	function es_carrito(){
		return ($this->concretada == 0);
	}
	function concretada() {
		return ($this->concretada > 0);
	}
}
?>