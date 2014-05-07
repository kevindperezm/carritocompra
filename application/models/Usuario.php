<?php

class Usuario extends ActiveRecord\Model{
	static $table_name = 'usuarios';
	static $has_many = array(
		array('selecciones', 
			  'class_name' => 'Compra', 
			  'conditions' => array('concretada = 0')),
		array('compras', 
			  'class_name' => 'Compra', 
			  'conditions' => array('concretada = 1')),
		array('tokens')
	);
	static $validates_uniqueness_of = array(
		array('nombre_usuario', 'message' => 'Nombre de usuario duplicado. Escriba otro.', 'on' => 'save')
	);
}

?>