<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function persistente($contexto, $tipo, $clave, $valor = null) {
	if ($valor != null) {
		$contexto->session->set_userdata($tipo."-".$clave, $valor);
	} else {
		return $contexto->session->userdata($tipo."-".$clave);
	}
} 

function pagina($contexto, $clave, $valor = null) {
	return persistente($contexto, 'pagina', $clave, $valor);
}


function link_pagina($contexto, $clave, $destino) {
	$retorno = pagina($contexto, $clave);
	if ($retorno === false) {
		return base_url().$destino;
	} else {
		return base_url().$destino.'/pagina/'.$retorno;
	}	
}

function redirigir_pagina($contexto, $clave, $destino) {
	// Ayuda a redirigir a $destino, pero con la última página visitada
	return redirect(link_pagina($contexto, $clave, $destino));
}

function filtro($contexto, $clave, $valor = null) {
	// Permite colocar u obtener la clave del filtro actual
	$ret = persistente($contexto, 'filtro', $clave, $valor);
	if ($ret === FALSE) $ret = 'todos';
	return $ret;
}

function filtro_merge($contexto, $clave, $condiciones = array()) {
	// Ayuda a concatenar arrays de condiciones según filtro
	$filtro = filtro($contexto, $clave);
		// Añadir filtro sólo si existe
	if ($filtro !== FALSE and array_key_exists($filtro, $contexto->filtros)) {
		$narray = array('conditions' => array($contexto->filtros[$filtro][1]));
		$condiciones = array_merge($condiciones, $narray);
	}
	return $condiciones;
}

function filtro_controller($contexto, $clave, $filtro) {
	// Ayuda a colocar el valor del filtro
	// No se puede colocar un filtro inválido
	if (array_key_exists($filtro, $contexto->filtros)) {
		filtro($contexto, $clave, $filtro);
	}
}

?>