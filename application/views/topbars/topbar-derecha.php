<?php
/* 
 | 
 | Genera un botón de acceso al carrito de compra,
 | con una medalla (badge) que indica la cantidad
 | de productos distintos que han sido añadidos al
 | carrito. También un botón para cerrar sesión.
 |
 */
?>
<ul class='nav navbar-nav navbar-right'>
	<li>
		<a href='<?=base_url()?>carrito'>
			<i class='glyphicon glyphicon-shopping-cart'></i> Carrito
			<?php
			$carrito = Compra::all(array(
				'conditions' => array('usuario_id = ? and concretada = 0', get_user_id($this)),
				'select' => '*, sum(precio_bruto) as precio_bruto_total, sum(cantidad) as cantidad_total',
				'group' => 'producto_id, variante_id'
				));
			if (sizeof($carrito) > 0) {
				echo " <span class='badge'>".sizeof($carrito)."</span>";
			} 
			?>
		</a>
	</li>
	<p class='navbar-text pull-left' style='margin-left: 1em'>
		<i class='glyphicon glyphicon-user'></i> Bienvenido, <?=$this->session->userdata('user_nombre')?>
	</p>
	<li class='pull-right'><a href="<?=base_url()?>logout" class='glyphicon glyphicon-log-out' title='Cerrar sesión'></a></li>
</ul>

