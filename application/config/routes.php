<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['404_override'] = '';

$route['usuario/(:any)'] = 'usuario_registrado/$1';
$route['usuario'] = 'usuario_registrado/index';

$route['categoria/(:any)/buscar'] = 'catalogo/buscar';
$route['categoria/(:any)'] = 'catalogo/categoria/$1';
$route['categoria'] = 'catalogo/index';

$route['(:any)/pagina'] = '$1/index';
$route['(:any)/pagina/(:num)'] = '$1/index/$2';

$route['producto/(:num)']='catalogo/producto/$1';

$route['admin/(:any)/pagina/(:num)'] = 'admin/$1/index/$2';
$route['admin/(:any)/pagina'] = 'admin/$1';

$route['admin'] = 'admin/index';
$route['logout'] = 'login/logout';

/* End of file routes.php */
/* Location: ./application/config/routes.php */