<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL para InfinityFree - Reemplaza TU_DOMINIO con tu dominio real
|
*/

$config['base_url'] = 'https://flota.infinityfree.me/';

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Para InfinityFree, es recomendable mantener index.php
|
*/
$config['index_page'] = 'index.php';

/*
|--------------------------------------------------------------------------
| Environment
|--------------------------------------------------------------------------
|
| Configuración para producción
|
*/
$config['environment'] = 'production';

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
|
| Desactivar errores en producción
|
*/
error_reporting(0);
ini_set('display_errors', 0);
