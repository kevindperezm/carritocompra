<?php


class Variante extends ActiveRecord\Model{
	static $table_name = 'variantes';
	static $belongs_to = array(
		array('producto'),
	);
}

?>