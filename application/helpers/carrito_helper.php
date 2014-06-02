<?php

function boton_carrito($contexto) {
  $carrito = Compra::all(array(
    'conditions' => array('usuario_id = ? and concretada = 0', get_user_id($contexto)),
    'select' => '*, sum(precio_bruto) as precio_bruto_total, sum(cantidad) as cantidad_total',
    'group' => 'producto_id, variante_id'
    ));
  // if (sizeof($carrito) > 0) {
    echo " <span class='badge'>".sizeof($carrito)."</span>";
  // } 
}

?>