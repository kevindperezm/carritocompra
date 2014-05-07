<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function basepath() {
	$ubicacion = $_SERVER['SCRIPT_FILENAME'];
	$basepath = explode(basename($ubicacion), $ubicacion);
	$basepath = $basepath[0];
	return $basepath;
}


/*
 |
 | Esta función devuelve una cadena de HTML que se puede usar para 
 | representar la variante seleccionada en una compra específica.
 | Requiere como parámetro el objeto compra cuya variante intenta 
 | mostrarse.
 |
 */
function mostrarVariante($compra) {
	if (!is_null($compra->variante)) {
		switch ($compra->variante->tipo_variante_id) {
			case VARIANTE_COLORES:
				return "Color: <div class='btn btn-primary colorDiv' style='background: ".$compra->variante->valor."'>";
				break;

			default:
				return 'Ninguna';
				break;
		}
	} else return 'Ninguna';
}

?>