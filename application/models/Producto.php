<?php


class Producto extends ActiveRecord\Model{
	static $table_name = 'productos';
	static $belongs_to = array(
		array('categoria'),
		array('medida')
	);
	static $has_many = array(
		array('selecciones', 
			  'class_name' => 'Compra', 
			  'conditions' => array('concretada = 0')),
		array('compras', 
			  'class_name' => 'Compra', 
			  'conditions' => array('concretada = 1')),
		array('variantes',
			  'order' => 'tipo_variante_id asc'
		)
	);
}

?>