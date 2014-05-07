<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/* 
|----------------------------- 
| Constantes personalizadas
| -----------------------------
| Las siguientes constantes son propias de esta aplicación.
| Son visibles en todos los archivos de la aplicación y cualquier
| constante que se piense usar en muchos sitios deberá definirse aquí.
|
*/

define('NOMBRE_TIENDA',							'CarritoCompra BETA');

/* Roles de usuario */
$GLOBALS['ROLES_USUARIO'] = array(
	2 => 'CLIENTE_COMUN',
	1 => 'ADMINISTRADOR'
);

foreach ($GLOBALS['ROLES_USUARIO'] as $key => $value) {
	define('ROLES_'.$value, $key);
}

# Definiendo constantes para el manejo de variantes.
# Es preferible que se definan aquí en lugar de que se almacenen en la BD
# ya que se requieren los valores de sus id's en la aplicación y no cambian
# constantemente, como los productos o los usuarios. Además, como debe
# actuarse de forma distinta con cada tipo de variante, esta es una mejor
# forma de utilizar mecanismos de flujo de control para ello.

# * Los nombres de las variantes deberán estar en plural.
# * El id de variante va como clave y el nombre como valor.

$GLOBALS['TIPOS_VARIANTE'] = array(
	1 => 'Colores'
);
foreach ($GLOBALS['TIPOS_VARIANTE'] as $key => $value) {
	define('VARIANTE_'.strtoupper($value), $key);
}

/* End of file constants.php */
/* Location: ./application/config/constants.php */