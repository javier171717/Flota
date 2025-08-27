<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
|
| There are three different routes you can use to route your requests.
| The default route is based on W3C standard not the most secure
| under the circumstances.
|
| There are two other routes to choose from, depending on your
| application, including one that can work with hex encoded URIs.
|
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rutas de autenticación
$route['auth/change_password'] = 'auth/change_password';
$route['auth/profile'] = 'auth/profile';
$route['auth/redirect_to_login'] = 'auth/redirect_to_login';
$route['auth/test_db'] = 'auth/test_db';
$route['auth/test_password_change'] = 'auth/test_password_change';


// Rutas de la flota
$route['flota'] = 'flota/index';
$route['flota/(:any)'] = 'flota/$1';

// Rutas de usuarios
$route['usuarios'] = 'usuarios/index';
$route['usuarios/(:any)'] = 'usuarios/$1';

// Rutas de vehículos
$route['vehiculos'] = 'vehiculos/index';
$route['vehiculos/(:any)'] = 'vehiculos/$1';

// Rutas de conductores
$route['conductores'] = 'conductores/index';
$route['conductores/(:any)'] = 'conductores/$1';

// Rutas de viajes
$route['viajes'] = 'viajes/index';
$route['viajes/(:any)'] = 'viajes/$1';

// Rutas de mantenimientos
$route['mantenimientos'] = 'mantenimientos/index';
$route['mantenimientos/(:any)'] = 'mantenimientos/$1';

// Rutas de reportes
$route['reportes'] = 'reportes/index';
$route['reportes/(:any)'] = 'reportes/$1';

// Rutas de configuración
$route['configuracion'] = 'configuracion/index';
$route['configuracion/(:any)'] = 'configuracion/$1';