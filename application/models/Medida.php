<?php


class Medida extends ActiveRecord\Model{
	static $has_many = array(
		array('productos')
	);
}
?>