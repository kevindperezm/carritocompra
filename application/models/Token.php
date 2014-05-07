<?php

class Token extends ActiveRecord\Model{
	static $table_name = 'tokens';
	static $belongs_to = array(
		array('usuario')
	);
	static $validates_uniqueness_of = array(
		array('string', 'message' => 'Token de seguridad inválido.', 'on' => 'create')
	);
	static $validates_presence_of = array(
		array('usuario_id', 'message' => 'Los token huerfános no están permitidos.', 'on' => 'create')
	);
}

?>