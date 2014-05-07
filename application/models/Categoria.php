<?php


class Categoria extends ActiveRecord\Model{
	static $table_name = 'categorias';
	static $has_many = array(
		array('productos')
	);
}

?>